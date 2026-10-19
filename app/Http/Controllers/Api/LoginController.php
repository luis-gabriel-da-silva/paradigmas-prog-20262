<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Services\LoginService;

class LoginController extends Controller
{
    public function __construct(private LoginService $loginService)
    {}

    public function login(LoginRequest $request)
    {
        return response()->json($this->loginService->login($request->validated()));
    }
}
