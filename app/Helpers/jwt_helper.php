<?php

use App\Models\UserModel;
use Config\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function getJWTFromRequest($authenticationHeader): string
{
    if (is_null($authenticationHeader)) { //JWT is absent
        throw new Exception('Missing or invalid JWT in request');
    }
    //JWT is sent from client in the format Bearer XXXXXXXXX
    return explode(' ', $authenticationHeader)[1];
}

function validateJWTFromRequest(string $encodedToken)
{
    $key = Services::getSecretKey();    
    $decodedToken = JWT::decode($encodedToken, new Key($key, 'HS256'));   
    return $decodedToken;
}

function getSignedJWTForUser(string $email)
{   
    $issuedAtTime = time();
    $tokenTimeToLive = strtotime('+1 day', $issuedAtTime);
    $tokenExpiration = $issuedAtTime + $tokenTimeToLive;
    $payload = [
        'email' => $email,
        'iat' => $issuedAtTime,
        'exp' => $tokenExpiration,
    ]; 
    $jwt = JWT::encode($payload, Services::getSecretKey(), 'HS256');
    return $jwt;
}
