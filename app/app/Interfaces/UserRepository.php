<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepository
{
    public function findByEmployeeNumber(string $employeeNumber): ?User;

    public function updatePassword(User $user, string $newPassword): void;

    public function savePassword(User $user, string $newPassword): void;

    public function findByEmployeeNumberAndEmail(string $employeeNumber, string $email): ?User;
}