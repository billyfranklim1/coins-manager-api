<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use App\Http\Resources\RegisterResource;
use App\Http\Resources\TokenResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\MessageResource;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{

    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $response = $this->authService->register($request->validated());
            return (new MessageResource([
                'message' => 'User registered successfully',
                'data' => new RegisterResource($response),
                'status' => 'success'
            ]))->response()->setStatusCode(201);
        }catch (\Exception $e) {

            Log::error($e->getMessage());

            return (new MessageResource([
                'message' => $e->getMessage(),
                'status' => 'error'
            ]))->response()->setStatusCode(400);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $response = $this->authService->login($request->validated());

            if(isset($response['status'])) {
                throw new \Exception($response['message'], $response['code']);
            }

            return (new MessageResource([
                'message' => 'Login successful',
                'data' => new TokenResource($response),
                'status' => 'success'
            ]))->response()->setStatusCode(200);
        } catch (\Exception $e) {
            return (new MessageResource([
                'message' => $e->getMessage(),
                'status' => 'error'
            ]))->response()->setStatusCode($e->getCode() ?: 400);
        }
    }


    public function refresh(Request $request)
    {
        try {
            $response = $this->authService->refresh();
            return (new MessageResource([
                'message' => 'Token refreshed successfully',
                'data' => new TokenResource($response),
                'status' => 'success'
            ]))->response()->setStatusCode(200);
        } catch (\Exception $e) {
            return (new MessageResource([
                'message' => $e->getMessage(),
                'status' => 'error',
            ]))->response()->setStatusCode(400);
        }
    }

    public function user(Request $request)
    {
        try {
            $user = $this->authService->user();
            return (new MessageResource([
                'message' => 'User data retrieved successfully',
                'data' => new UserResource($user),
                'status' => 'success'
            ]))->response()->setStatusCode(200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return (new MessageResource([
                'message' => $e->getMessage(),
                'status' => 'error'
            ]))->response()->setStatusCode(400);
        }
    }


    public function logout(Request $request)
    {
        try {
            $this->authService->logout();
            return (new MessageResource([
                'message' => 'Logout successful',
                'data' => null,
                'status' => 'success'
            ]))->response()->setStatusCode(200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return (new MessageResource([
                'message' => $e->getMessage(),
                'status' => 'error'
            ]))->response()->setStatusCode(400);
        }
    }

}
