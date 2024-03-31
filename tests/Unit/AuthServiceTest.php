<?php

namespace Tests\Unit\Services;

use App\Contracts\IAuthRepository;
use App\Services\AuthService;
use PHPUnit\Framework\TestCase;
use Mockery;

class AuthServiceTest extends TestCase
{
    protected $authRepository;
    protected $authService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authRepository = Mockery::mock(IAuthRepository::class);
        $this->authService = new AuthService($this->authRepository);
    }

    public function testRegister()
    {
        $attributes = ['name' => 'User', 'email' => 'test@example.com', 'password' => 'password', 'password_confirmation' => 'password'];
        $this->authRepository->shouldReceive('register')
            ->once()
            ->with($attributes)
            ->andReturn(['id' => 1, 'name' => 'User', 'email' => 'test@example.com']);

        $result = $this->authService->register($attributes);
        $this->assertEquals(['id' => 1, 'name' => 'User', 'email' => 'test@example.com'], $result);
    }

    public function testLogin()
    {
        $credentials = ['email' => 'user@example.com', 'password' => 'password'];
        $this->authRepository->shouldReceive('login')
            ->once()
            ->with($credentials)
            ->andReturn(['access_token' => 'token', 'token_type' => 'Bearer']);

        $result = $this->authService->login($credentials);
        $this->assertEquals(['access_token' => 'token', 'token_type' => 'Bearer'], $result);
    }

    public function testRefresh()
    {
        $this->authRepository->shouldReceive('refresh')
            ->once()
            ->andReturn(['access_token' => 'new_token', 'token_type' => 'Bearer']);

        $result = $this->authService->refresh();
        $this->assertEquals(['access_token' => 'new_token', 'token_type' => 'Bearer'], $result);
    }

    public function testUser()
    {
        $userDetails = ['id' => 1, 'email' => 'user@example.com', 'name' => 'User'];
        $this->authRepository->shouldReceive('user')
            ->once()
            ->andReturn((object) $userDetails);

        $result = $this->authService->user();
        $this->assertEquals((object) $userDetails, $result);
    }

    public function testLogout()
    {
        $this->authRepository->shouldReceive('logout')
            ->once()
            ->andReturn(['message' => 'Tokens Revoked']);

        $result = $this->authService->logout();
        $this->assertEquals(['message' => 'Tokens Revoked'], $result);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
