<?php

namespace TomatoPHP\TomatoAdmin\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use TomatoPHP\TomatoAdmin\Actions\Fortify\CreateNewUser;
use TomatoPHP\TomatoAdmin\Actions\Fortify\ResetUserPassword;
use TomatoPHP\TomatoAdmin\Actions\Fortify\UpdateUserPassword;
use TomatoPHP\TomatoAdmin\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::loginView(function () {
            return view('tomato-admin::auth.login');
        });

        Fortify::registerView(function () {
            return view('tomato-admin::auth.register');
        });

        Fortify::requestPasswordResetLinkView(function () {
            return view('tomato-admin::auth.forgot-password');
        });

        Fortify::twoFactorChallengeView(function () {
            return view('tomato-admin::auth.two-factor-challenge');
        });

        Fortify::verifyEmailView(function () {
            return view('tomato-admin::auth.verify-email');
        });



        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
