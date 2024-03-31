<?php

namespace App\Services;
use App\Contracts\IAuthRepository;

class AuthService
{
    protected IAuthRepository $authRepository;

    /**
     * @param IAuthRepository $authRepository
     */
    public function __construct(IAuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function register(array $attributes)
    {
        return $this->authRepository->register($attributes);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function login(array $attributes)
    {
        return $this->authRepository->login($attributes);
    }

    /**
     * @return mixed
     */
    public function refresh()
    {
        return $this->authRepository->refresh();
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->authRepository->user();
    }

    /**
     * @return mixed
     */
    public function logout()
    {
        return $this->authRepository->logout();
    }

}
