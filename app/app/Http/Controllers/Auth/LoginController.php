<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Interfaces\AuthService as AuthServiceInterface;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __construct(private AuthServiceInterface $auth)
    {
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $data = $request->safe()->only(['employee_number', 'password']);

        if ($this->auth->attemptLogin($data['employee_number'], $data['password'])) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        throw ValidationException::withMessages([
            'employee_number' => __('auth.failed'),
        ]);
    }

    public function logout(Request $request)
    {
        $this->auth->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('login');
    }
}