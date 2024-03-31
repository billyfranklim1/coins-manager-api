<?php

namespace App\Repositories;

use App\Contracts\IAuthRepository;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements IAuthRepository
{
    protected User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     * @return User
     */
    public function register(array $attributes) : User
    {
        return $this->model->create($attributes);
    }

    /**
     * @param array $attributes
     * @throws \Exception
     */
    public function login(array $attributes) : array
    {
        $user = $this->model->where('email', $attributes['email'])->first();

        if (!$user || !Auth::attempt($attributes)) {
            return ['message' => 'Invalid credentials', 'status' => 'error', 'code' => 401];
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];
    }

    /**
     * @return array
     */
    public function refresh() : array
    {
        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];

    }

    /**
     * @return Authenticatable
     */
    public function user() : Authenticatable
    {
        return Auth::user();
    }

    /**
     * @return array
     */
    public function logout() : array
    {
        Auth::user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }


}
