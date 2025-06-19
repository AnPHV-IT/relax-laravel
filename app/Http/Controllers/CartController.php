<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\UserModel;
use Exception;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->attributes->get('user');

        if (!$user) return redirect()->to('/login');

        $carts = $user->carts()->with('color', 'category', 'product')->get();

        return view('users.cart.index', compact('user', "carts"));
    }

    public function addTocart(Request $req)
    {
        try {
            $data = $req->except("_token");

            $user = $req->attributes->get('user');

            if (!$user instanceof UserModel) {
                return redirect()->to('/login');
            }


            $existingCartItem = Cart::where('userId', $user->id)
                ->where('productId', $data['productId'])
                ->where('colorId', $data['colorId'])
                ->where('categoryId', $data['categoryId'])
                ->first();

            if ($existingCartItem) {
                $existingCartItem->amount += $data['amount'];
                $existingCartItem->save();
            } else {

                Cart::create([
                    "userId" => $user->id,
                    "colorId" => $data["colorId"],
                    "categoryId" => $data["categoryId"],
                    "amount" => $data["amount"],
                    "productId" => $data["productId"]
                ]);
            }


            return redirect()->to('/cart');
        } catch (Exception $err) {
            Log::error("Add To Cart Error: {$err->getMessage()}");
            return redirect()->back();
        }
    }

    public function cartDelete($cartId, Request $req)
    {
        try {
            $user = $req->attributes->get('user');

            if (!$user instanceof UserModel) {
                return redirect()->to('/login');
            }

            $cartItem = Cart::where('id', $cartId)
                ->where('userId', $user->id)
                ->firstOrFail();
            $cartItem->delete();


            return redirect()->to('/cart');
        } catch (Exception $err) {
            Log::error("Add To Cart Error: {$err->getMessage()}");
            return redirect()->back();
        }
    }

    public function AddOrder(Request $req)
    {
        try {

            $user = $req->attributes->get('user');

            if (!$user instanceof UserModel) {
                return redirect()->to('/login');
            }

            $carts = $req->get('carts');

            foreach ($carts as $cartData) {

                $amount = $cartData['amount'];
                $productId = $cartData['productId'];
                $colorId = $cartData['colorId'];
                $categoryId = $cartData['categoryId'];


                Order::create([
                    'userId' => $user->id,
                    'productId' => $productId,
                    'colorId' => $colorId,
                    'categoryId' => $categoryId,
                    'amount' => $amount,

                ]);
            }

            Cart::where(["userId" => $user->id])->delete();

            return redirect()->to('/orders');
        } catch (Exception $err) {
            Log::error("Add To Cart Error: {$err->getMessage()}");
            return redirect()->back();
        }
    }

    public function OrderView(Request $request)
    {
        $user = $request->attributes->get('user');

        if (!$user) return redirect()->to('/login');

        $orders = $user->orders()->with('color', 'category', 'product')->get();

        return view('users.cart.order', compact('user', "orders"));
    }
}
