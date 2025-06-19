<?php

namespace App\Http\Middleware;

use App\Models\UserModel;
use App\Utilities\TokenUtility;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AdminProtected
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $token = $request->cookie('authentication');
            if(!$token) return redirect()->to('/login');
            $payload = TokenUtility::verifyAccessToken(str_replace('Bearer ', '', $token));

            if(!$payload) return redirect()->to('/login');
            
            $user = UserModel::where(['id' => $payload->id])->first();

            if(!$user) return redirect()->to('/login');

            Log::info($user->role);

            if($user->role !== "admin") return redirect()->to('/');

            $request->attributes->set('user', $user);

            return $next($request);
        } catch(Exception $e) {
            return response()->json([
                "message" => $e->getMessage(),
                "status" => 500 
            ], 500);
        }
    }
}
