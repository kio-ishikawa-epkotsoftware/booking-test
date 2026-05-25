<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        // 編集対象のモデルID を取得
        $userId = $this->route('user')->id;

        return [
            'password'        => [
                'nullable',
                'string',
                'min:4',
                'confirmed',
            ],
            'name'            => 'required|string|max:255',
            'is_admin'        => 'required|boolean',
        ];
    }

    /**
     * フレンドリーフィールド名
     */
    public function attributes(): array
    {
        return [
            'password'               => 'パスワード',
            'name'                   => '名前',
            'is_admin'               => '管理者フラグ',
        ];
    }
}