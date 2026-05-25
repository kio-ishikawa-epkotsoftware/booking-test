<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * このリクエストを行えるか（管理者のみ許可）
     */
    public function authorize(): bool
    {
        return $this->user()?->is_admin === true;
    }

    /**
     * バリデーションルール
     */
    public function rules(): array
    {
        return [
            'employee_number' => [
                'required',
                'string',
                'regex:/^[0-9]+$/',
                'unique:users,employee_number',
            ],
            'password'        => 'required|string|max:100',
            'name'            => 'required|string|max:100',
            'is_admin'        => 'required|boolean',
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
            'name'            => '名前',
            'is_admin'        => '管理者フラグ',
        ];
    }
}