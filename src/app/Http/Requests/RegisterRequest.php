<?php

namespace App\Http\Requests;

use Laravel\Fortify\Http\Requests\RegisterRequest as FortifyRegisterRequest;

class RegisterRequest extends FortifyRegisterRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // ユーザー名：空欄不可、文字列、最大50文字
            'name' => ['required', 'string', 'max:50'],

            // メールアドレス：空欄不可、メール形式、最大100文字、usersテーブルで重複不可
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users,email'],

            // パスワード：空欄不可、最低8文字、確認用(password_confirmation)と一致必須
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'ユーザー名を入力してください',
            'name.max' => 'ユーザー名は50文字以内で設定してください',
            'email.required' => 'メールアドレスは必須です',
            'email.email' => '有効なメールアドレスを入力してください',
            'email.unique' => 'このメールアドレスは既に登録されています',
            'password.required' => 'パスワードを設定してください',
            'password.min' => 'パスワードは8文字以上で入力してください',
            'password.confirmed' => 'パスワードが一致しません',
        ];
    }
}
