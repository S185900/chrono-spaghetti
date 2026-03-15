<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Laravel\Fortify\Http\Responses\LogoutResponse;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            \Laravel\Fortify\Http\Requests\RegisterRequest::class,
            \App\Http\Requests\RegisterRequest::class
        );

        $this->app->singleton(
            \Laravel\Fortify\Http\Requests\LoginRequest::class,
            \App\Http\Requests\LoginRequest::class
        );

        // ログアウト後のリダイレクト先をカスタマイズ
        $this->app->singleton(LogoutResponse::class, function () {
            // implements ではなく extends に変更
            return new class extends LogoutResponse {
                public function toResponse($request)
                {
                    return redirect('/');
                }
            };
        });
    }

    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::authenticateUsing(function (Request $request) {
            Validator::make($request->all(), [
                Fortify::username() => 'required|string',
                'password' => 'required|string',
            ], [
                'email.required' => 'メールアドレスを入力してください',
                'email.email' => '有効なメールアドレスを入力してください',
                'password.required' => 'パスワードを入力してください',
            ])->validate();

            $user = \App\Models\User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }

            throw \Illuminate\Validation\ValidationException::withMessages([
                Fortify::username() => ['メールアドレスまたはパスワードが正しくありません'],
            ]);
        });

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

        $this->app->bind(
            \Laravel\Fortify\Http\Requests\RegisterRequest::class,
            \App\Http\Requests\RegisterRequest::class
        );
    }

}
