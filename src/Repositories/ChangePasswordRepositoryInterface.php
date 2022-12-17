<?php

namespace App\Repositories;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

interface ChangePasswordRepositoryInterface
{
   
    public function queryUpdatePassword($conn, Request $request, Response $response);
}
