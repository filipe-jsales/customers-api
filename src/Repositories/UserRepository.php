<?php
namespace App\Repositories;

use App\Repositories\UserRepositoryInterface;
use PDO;

class UserRepository implements UserRepositoryInterface
{
    public function querySelectUser($connection, $request) {
        $user = $connection->prepare('SELECT * FROM wp_users WHERE user_email = :user_email');
        $user->bindValue(':user_email', $request->email);
        $user->execute();

        $data = $user->fetch(PDO::FETCH_OBJ);
        return $data;
    }
}