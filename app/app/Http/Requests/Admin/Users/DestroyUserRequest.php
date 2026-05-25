<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class DestroyUserRequest extends FormRequest
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
        return [];
    }

    /**
     * フレンドリーフィールド名
     */
    public function attributes(): array
    {
        return [];
    }
}