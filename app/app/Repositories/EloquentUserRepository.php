<?php

namespace App\Repositories;

use App\Interfaces\UserRepository;
use App\Models\User;

class EloquentUserRepository implements UserRepository
{
    public function __construct(private User $model)
    {
    }

    public function findByEmployeeNumber(string $employeeNumber): ?User
    {
        return $this->model->newQuery()
            ->where('employee_number', $employeeNumber)
            ->first();
    }

    public function updatePassword(User $user, string $newPassword): void
    {
        $user->password = $newPassword;
        $user->save();
    }

    public function savePassword(User $user, string $newPassword): void
    {
        $user->password = $newPassword;
        $user->save();
    }

    public function findByEmployeeNumberAndEmail(string $employeeNumber, string $email): ?User
    {
        return $this->model->newQuery()
            ->where('employee_number', $employeeNumber)
            ->where('email', $email)
            ->first();
    }
}