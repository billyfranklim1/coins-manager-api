<?php

namespace App\Contracts;

interface IAuthRepository
{
    /**
     * @param array $attributes
     * @return mixed
     */
    public function register(array $attributes);

    /**
     * @param array $attributes
     * @return mixed
     */
    public function login(array $attributes);

    /**
     * @return mixed
     */
    public function refresh();

    /**
     * @return mixed
     */
    public function user();

    /**
     * @return mixed
     */
    public function logout();
}
