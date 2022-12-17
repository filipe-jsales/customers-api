<?php

namespace App\Repositories;

use App\Models\PasswordHash;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ChangePasswordRepository implements ChangePasswordRepositoryInterface
{
    public function wp_hash_password( $password ) {
        global $wp_hasher;
    
        if ( empty( $wp_hasher ) ) {
            $wp_hasher = new PasswordHash( 8, true );
        }
    
        return $wp_hasher->HashPassword( trim( $password ) );
    }
    
    public function queryUpdatePassword($connection, Request $request, Response $response){
        //hashing password before updating the database
        $wp_hash_pass = $this->wp_hash_password($request->password);
        $query = $connection->prepare("UPDATE wp_users SET user_pass = ? WHERE user_email = ?");
        $query->execute([$wp_hash_pass, $request->email]);

        // return $response
        //     ->withHeader('content-type', 'application/json')
        //     ->withStatus(200);
    }
}