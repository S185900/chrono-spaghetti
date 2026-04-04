<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // テストユーザーの作成
        User::updateOrCreate(
            ['email' => 'test@mail.com'], // メールアドレスが重複しないようにチェック
            [
                'name' => 'Test User',
                'password' => Hash::make('password123'), // パスワードを暗号化
                'email_verified_at' => now(), // メール認証済みに設定
            ]
        );
    }
}