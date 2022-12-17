<?php

namespace App\Services;

use App\Repositories\ChangePasswordRepository;
use App\Repositories\UserRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ChangePasswordService
{   
    protected $change_password_repository;
    protected $connect_service;
    protected $user_repository;

    public function __construct(
        ConnectService $connect_service,
        ChangePasswordRepository $change_password_repository,
        UserRepository $user_repository
    )
    {
        $this->change_password_repository = $change_password_repository;
        $this->connect_service = $connect_service;
        $this->user_repository = $user_repository;
    }

    public function changePassword(Request $request, Response $response) {
        $conn = $this->connect_service->connectDataBase();
        $user = $this->user_repository->querySelectUser($conn, $request);
        if(!isset($user->email))
        {
            return $response
            ->withHeader('content-type', 'application/json')
            ->withStatus(422);
        }
        return $this->change_password_repository->queryUpdatePassword($conn, $request, $response);
    }

}