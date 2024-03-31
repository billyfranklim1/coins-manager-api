<?php

namespace App\Providers;

use App\Contracts\IAuthRepository;
use App\Repositories\AuthRepository;
use App\Contracts\ICoinRepository;
use App\Repositories\CoinRepository;
use App\Contracts\IQuoteRepository;
use App\Repositories\QuoteRepository;
use Illuminate\Support\ServiceProvider;
use App\Contracts\HttpClientInterface;
use App\Services\HttpClientService;
use App\Repositories\GroupRepository;
use App\Contracts\IGroupRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IAuthRepository::class, AuthRepository::class);
        $this->app->bind(ICoinRepository::class, CoinRepository::class);
        $this->app->bind(IQuoteRepository::class, QuoteRepository::class);
        $this->app->bind(HttpClientInterface::class, HttpClientService::class);
        $this->app->bind(IGroupRepository::class, GroupRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
