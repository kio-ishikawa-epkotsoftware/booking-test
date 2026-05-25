<?php

namespace App\Interfaces;

interface AuthService
{
    public function attemptLogin(string $employeeNumber, string $password): bool;
    public function logout(): void;
}