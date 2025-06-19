<?php

namespace App\Utilities;

use App\Models\UserModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class TokenUtility
{
    /**
     * Create a new class instance.
     */ 

    private static $secretKey;
    private static $issuer;

    public static function initialize()
    {
        if (is_null(self::$secretKey) || is_null(self::$issuer)) {
            self::$secretKey = env('JWT_SECRET');
            self::$issuer = env('JWT_ISSUER');

            Log::info('JWT_SECRET: ' . self::$secretKey);
            Log::info('JWT_ISSUER: ' . self::$issuer);
        }
    }
    
    public static function signAccessToken(UserModel $user)
    {
        self::initialize();

        $payload = [
            'iss' => self::$issuer,
            'sub' => [
                "id" => $user->id,
                "email" => $user->email,
                "role" => $user->role,
            ],
            'iat' => time(),
            'exp' => time() + (60 * 60)
        ];

        return JWT::encode($payload, self::$secretKey, 'HS256');
    }

    public static function verifyAccessToken($token)
    {
        try {
            self::initialize();
            $payload = JWT::decode($token, new Key(self::$secretKey, 'HS256'));
            return $payload->sub;
        } catch (\Exception $e) {
            return null;
        }
    }

}
