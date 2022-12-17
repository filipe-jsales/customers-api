<?php

namespace App\Services;

use PDO;
use PDOException;
use Psr\Http\Message\ResponseInterface as Response;

class ConnectService
{

    public function connectDataBase()
    {
        // $response = new Response;
        try {
            $mysql_host = 'localhost';
            $mysql_user = 'root';
            $mysql_password =  '123';
            $mysql_database = 'wordpress';
            $conn = new PDO(
                "mysql:host=$mysql_host;dbname=$mysql_database",
                $mysql_user,
                $mysql_password
            );
        } catch (PDOException) {
            return "Could not connect";
        }
        
        return $conn;
    }
}