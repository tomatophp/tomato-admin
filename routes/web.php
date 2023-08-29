<?php

use Illuminate\Support\Facades\Route;
use \TomatoPHP\TomatoAdmin\Http\Controllers\DashboardController;
use TomatoPHP\TomatoPHP\Http\Middleware\LanguageSwitcher;

Route::middleware(array_merge(['splade'], config('tomato-admin.route_middlewares')))->prefix(config('tomato-admin.route_perfix'))->name(config('tomato-admin.route_perfix') . '.')->group(function () {
    Route::get('register', [\TomatoPHP\TomatoAdmin\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [\TomatoPHP\TomatoAdmin\Http\Controllers\Auth\RegisteredUserController::class, 'store']);

    Route::get('login', [\TomatoPHP\TomatoAdmin\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [\TomatoPHP\TomatoAdmin\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [\TomatoPHP\TomatoAdmin\Http\Controllers\Auth\PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [\TomatoPHP\TomatoAdmin\Http\Controllers\Auth\PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [\TomatoPHP\TomatoAdmin\Http\Controllers\Auth\NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [\TomatoPHP\TomatoAdmin\Http\Controllers\Auth\NewPasswordController::class, 'store'])->name('password.store');
});


Route::middleware(array_merge(['splade', 'auth'], config('tomato-admin.route_middlewares')))->prefix(config('tomato-admin.route_perfix'))->name(config('tomato-admin.route_perfix'))->group(function (){
    Route::get('/', [\TomatoPHP\TomatoAdmin\Http\Controllers\DashboardController::class, 'index']);
    Route::post('/switch', [\TomatoPHP\TomatoAdmin\Http\Controllers\DashboardController::class, 'switchLang'])->name('.lang');
    Route::get('/profile', [\TomatoPHP\TomatoAdmin\Http\Controllers\DashboardController::class, 'profile'])->name('.profile.edit');
    Route::patch('/profile', [\TomatoPHP\TomatoAdmin\Http\Controllers\DashboardController::class, 'update'])->name('.profile.update');
    Route::put('/profile/password', [\TomatoPHP\TomatoAdmin\Http\Controllers\DashboardController::class, 'password'])->name('.profile.password');
    Route::delete('/profile', [\TomatoPHP\TomatoAdmin\Http\Controllers\DashboardController::class, 'destroy'])->name('.profile.destroy');

    Route::get('verify-email', [\TomatoPHP\TomatoAdmin\Http\Controllers\Auth\EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', [\TomatoPHP\TomatoAdmin\Http\Controllers\Auth\VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('email/verification-notification', [\TomatoPHP\TomatoAdmin\Http\Controllers\Auth\EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
    Route::get('confirm-password', [\TomatoPHP\TomatoAdmin\Http\Controllers\Auth\ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [\TomatoPHP\TomatoAdmin\Http\Controllers\Auth\ConfirmablePasswordController::class, 'store'])->name('password.confirm.post');

    Route::put('password', [\TomatoPHP\TomatoAdmin\Http\Controllers\Auth\PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [\TomatoPHP\TomatoAdmin\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('.logout');
});
