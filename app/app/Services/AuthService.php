<?php

namespace App\Services;

use App\Interfaces\AuthService as AuthServiceContract;
use App\Interfaces\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthServiceContract
{
    public function __construct(private UserRepository $users)
    {
    }

    public function attemptLogin(string $employeeNumber, string $password): bool
    {
        $user = $this->users->findByEmployeeNumber($employeeNumber);
        if (!$user || !Hash::check($password, $user->password)) {
            return false;
        }

        Auth::login($user);
        return true;
    }

    public function logout(): void
    {
        Auth::logout();
    }
}