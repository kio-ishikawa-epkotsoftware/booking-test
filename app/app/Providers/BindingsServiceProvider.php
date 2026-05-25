<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\AuthService as AuthServiceInterface;
use App\Interfaces\ForgotPasswordService as ForgotPasswordServiceInterface;
use App\Interfaces\UserRepository as UserRepositoryInterface;
use App\Services\AuthService;
use App\Repositories\EloquentUserRepository;
use App\Interfaces\ChangePasswordService as PasswordServiceInterface;
use App\Services\ForgotPasswordService;
use App\Services\ChangePasswordService;

class BindingsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        /*$this->app->bind(PasswordServiceInterface::class, ChangePasswordService::class);
        $this->app->bind(ForgotPasswordServiceInterface::class, ForgotPasswordService::class);*/
    }
}