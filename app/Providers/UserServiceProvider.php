<?php

namespace App\Providers;

use App\Services\User\Contract\UserServiceContract;
use App\Services\User\UserService;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(
            UserServiceContract::class,
            UserService::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return string[]
     */
    public function boot(): array
    {
        return [UserServiceContract::class];
    }
}
