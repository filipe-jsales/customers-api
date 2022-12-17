<?php

namespace App\Repositories;
use Psr\Http\Message\ServerRequestInterface as Request;

interface UserRepositoryInterface
{
    public function querySelectUser($conn, Request $request);
}
