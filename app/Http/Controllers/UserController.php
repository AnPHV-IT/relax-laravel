<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Utilities\TokenUtility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct() {}
    // -------------------------------------------- POST ------------------------------------------
    public function CreateUser(Request $req)
    {
        if (Auth::check()) return redirect()->to('/');

        $data = $req->except("_token");

        $existingUser = UserModel::where(["email" => $data["email"]])->first();

        if ($existingUser) return redirect()->back()->withErrors(["existingEmail" => "email đã tồn tại"])->withInput();

        $user = UserModel::create([
            "email" => $data["email"],
            "password" => bcrypt($data["password"]),
            "address" => $data["address"],
            "name" => $data["name"],
        ]);

        $token = TokenUtility::signAccessToken($user);

        return redirect()
            ->to('/')
            ->withCookie(cookie('authentication', "Bearer {$token}", 60));
    }

    public function SignIn(Request $req)
    {
        $data = $req->except("_token");

        $user = UserModel::where(["email" => $data["email"]])->first();

        $isValidPassword = Hash::check($data['password'], $user->password);

        if (!$user || !$isValidPassword) {
            return redirect()
                ->back()
                ->withErrors(["validate.invalid" => "Email or password is incorrect"])
                ->withInput();
        }

        $signToken = TokenUtility::signAccessToken($user);

        return redirect()
            ->to('/')
            ->withCookie(cookie('authentication', "Bearer {$signToken}", 60));
    }

    // -------------------------------------------- GET ------------------------------------------
    public function signUpPage(Request $req)
    {
        $tokenFromCookie = $req->cookie('authentication');
        $token = str_replace('Bearer ', '', $tokenFromCookie);
        $decodeToken = TokenUtility::verifyAccessToken($token);

        if ($decodeToken) {
            return redirect()->to('/');
        }

        return view("users.auth.signUp");
    }

    public function signInPage(Request $req)
    {
        $tokenFromCookie = $req->cookie('authentication');
        $token = str_replace('Bearer ', '', $tokenFromCookie);
        $decodeToken = TokenUtility::verifyAccessToken($token);

        if ($decodeToken) {
            return redirect()->to('/');
        }

        return view("users.auth.signIn");
    }

    // public function main() {
    //     return view('welcome');
    // }
    // -----cập nhật ở trên-----
    public function main()
    {
        return view('users.home.index');
    }
}
