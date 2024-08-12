<?php

namespace App\helper;
use  firebase\JWT\JWT;
use PHPUnit\Exception;

class jwtToken
{
    public static function createToken($userEmail): string               // user email address
    {
        $key = env('JWT_KEY');
        $payload = [
            'iss' => 'laravel',    // issuer name
            'iat' => time(),        // issuer time  , time() current time
            'exp' => time() + 60*60,  // expire date
            'userEmail' => $userEmail,      // user email address receive
        ];
        return JWT::encode($payload, $key, 'HS256');  // return type string
    }
    public static function  VerifyToken($token):string
    {
        try {
            $key = env('JWT_KEY');
            $decoded = JWT::decode($token, new key($key, 'HS256'));
            return $decoded->userEmail;
        }
        catch (Exception $e){
            return 'Unauthorized';
        }

    }
}
