<?php

namespace App\Http\Helper;

use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use DateTimeImmutable;
use Firebase\JWT\Key;
use Tymon\JWTAuth\Exceptions\JWTException as ExceptionsJWTException;

class PublicHelper
{
    // get jwt info from header
    public function GetRawJWT()
    {
        // check if header exists
        if (empty($_SERVER['HTTP_AUTHORIZATION'])) {
            throw new JWTException('authorization header not found');
        }

        // check if bearer token exists
        if (! preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
            throw new  JWTException('token not found');
        }

        // extract token
        $jwt = $matches[1];
        if (!$jwt) {
            throw new JWTException('could not extract token');
        }

        return $jwt;
    }

    public function DecodeRawJWT($jwt)
    {
        // use secret key to decode token
        $secretKey  = env('JWT_KEY');
        try {
            $token = JWTAuth::decode($jwt, new Key($secretKey, 'HS512'));
            $now = new DateTimeImmutable();
        } catch (Exception $e) {
            throw new JWTException('unauthorized');
        }

        return $token;
    }

    public function GetAndDecodeJWT()
    {
        $jwt = $this->GetRawJWT();
        $token = $this->DecodeRawJWT($jwt);

        return $token;
    }
}
