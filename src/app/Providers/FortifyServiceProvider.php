<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // 会員登録用（これは残しておいてOK）
        $this->app->singleton(
            \Laravel\Fortify\Http\Requests\RegisterRequest::class,
            \App\Http\Requests\RegisterRequest::class
        );

        // ログイン用（これがないから無視されていました！）
        $this->app->singleton(
            \Laravel\Fortify\Http\Requests\LoginRequest::class,
            \App\Http\Requests\LoginRequest::class
        );
    }

    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        // ログインバリデーションのカスタマイズ
        Fortify::authenticateUsing(function (Request $request) {
            // バリデーションを実行
            Validator::make($request->all(), [
                Fortify::username() => 'required|string',
                'password' => 'required|string',
            ], [
                'email.required' => 'メールアドレスを入力してください',
                'email.email' => '有効なメールアドレスを入力してください',
                'password.required' => 'パスワードを入力してください',
            ])->validate();

            // 認証処理
            $user = \App\Models\User::where('email', $request->email)->first();

            // Hash::check を使うために冒頭の use 指定が必要です
            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }

            // 認証失敗時
            throw \Illuminate\Validation\ValidationException::withMessages([
                Fortify::username() => ['メールアドレスまたはパスワードが正しくありません'],
            ]);
        });

        // --- 以下、既存の RateLimiter や View 設定 ---
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());
            return Limit::perMinute(5)->by($throttleKey);
        });

        Fortify::loginView(function () {
            return view('auth.login');
        });

        Fortify::registerView(function () {
            return view('auth.register');
        });

        Fortify::verifyEmailView(function () {
            return view('auth.email-verification');
        });

        // 念押しのバインド
        $this->app->bind(
            \Laravel\Fortify\Http\Requests\RegisterRequest::class,
            \App\Http\Requests\RegisterRequest::class
        );
    }

}
