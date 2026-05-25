<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * このリクエストを行えるか
     */
    public function authorize(): bool
    {
        //未ログイン状態が前提なので、常にtrue
        return true;
    }

    /**
     * バリデーションルール
     */
    public function rules(): array
    {
        return [
            'employee_number' => 'required',
            'password'        => 'required',
        ];
    }

    /**
     * フレンドリーフィールド名
     */
    public function attributes(): array
    {
        return [
            'employee_number' => '社員番号',
            'password'        => 'パスワード',
        ];
    }
}