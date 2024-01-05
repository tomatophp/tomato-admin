<?php

use Illuminate\Support\Facades\Route;
use \TomatoPHP\TomatoAdmin\Http\Controllers\DashboardController;
use TomatoPHP\TomatoPHP\Http\Middleware\LanguageSwitcher;
use Laravel\Jetstream\Jetstream;

Route::middleware(array_merge(['splade'], config('tomato-admin.route_middlewares')))->prefix(config('tomato-admin.route_perfix'))->name(config('tomato-admin.route_perfix') . '.')->group(function () {
    if (Jetstream::hasTermsAndPrivacyPolicyFeature()) {
        Route::get('/terms-of-service', [\TomatoPHP\TomatoAdmin\Http\Controllers\TermsOfServiceController::class, 'show'])->name('terms.show');
        Route::get('/privacy-policy', [\TomatoPHP\TomatoAdmin\Http\Controllers\PrivacyPolicyController::class, 'show'])->name('policy.show');
    }
});


Route::middleware(array_merge(['splade', 'auth'], config('tomato-admin.route_middlewares')))->prefix(config('tomato-admin.route_perfix'))->name(config('tomato-admin.route_perfix'))->group(function (){
    //Dashboard Actions
    Route::get('/', [\TomatoPHP\TomatoAdmin\Http\Controllers\DashboardController::class, 'index']);
    Route::post('/switch', [\TomatoPHP\TomatoAdmin\Http\Controllers\DashboardController::class, 'switchLang'])->name('.lang');

    //Profile
    Route::get('/profile', [\TomatoPHP\TomatoAdmin\Http\Controllers\UserProfileController::class, 'show'])->name('.profile.edit');
    Route::get('/profile/teams', [\TomatoPHP\TomatoAdmin\Http\Controllers\UserProfileController::class, 'teams'])->name('.profile.teams');
    Route::patch('/profile', [\TomatoPHP\TomatoAdmin\Http\Controllers\UserProfileController::class, 'update'])->name('.profile.update');
    Route::put('/profile/password', [\TomatoPHP\TomatoAdmin\Http\Controllers\UserProfileController::class, 'password'])->name('.profile.password');
    Route::delete('/profile', [\TomatoPHP\TomatoAdmin\Http\Controllers\UserProfileController::class, 'destroy'])->name('.profile.destroy');


    // User & Profile...
    Route::get('/user/profile', [\Laravel\Jetstream\Http\Controllers\Inertia\UserProfileController::class, 'show'])->name('.profile.show');
    Route::delete('/user/other-browser-sessions', [\TomatoPHP\TomatoAdmin\Http\Controllers\OtherBrowserSessionsController::class, 'destroy'])->name('.other-browser-sessions.destroy');
    Route::delete('/user/profile-photo', [\TomatoPHP\TomatoAdmin\Http\Controllers\ProfilePhotoController::class, 'destroy'])->name('.current-user-photo.destroy');

    if (Jetstream::hasAccountDeletionFeatures()) {
        Route::delete('/user', [\TomatoPHP\TomatoAdmin\Http\Controllers\CurrentTeamController::class, 'destroy'])
            ->name('.current-user.destroy');
    }

    Route::group(['middleware' => 'verified'], function () {
        // API...
        if (Jetstream::hasApiFeatures()) {
            Route::get('/user/api-tokens', [\TomatoPHP\TomatoAdmin\Http\Controllers\ApiTokenController::class, 'index'])->name('.api-tokens.index');
            Route::post('/user/api-tokens', [\TomatoPHP\TomatoAdmin\Http\Controllers\ApiTokenController::class, 'store'])->name('.api-tokens.store');
            Route::get('/user/api-tokens/{token}', [\TomatoPHP\TomatoAdmin\Http\Controllers\ApiTokenController::class, 'edit'])->name('.api-tokens.edit');
            Route::put('/user/api-tokens/{token}', [\TomatoPHP\TomatoAdmin\Http\Controllers\ApiTokenController::class, 'update'])->name('.api-tokens.update');
            Route::delete('/user/api-tokens/{token}', [\TomatoPHP\TomatoAdmin\Http\Controllers\ApiTokenController::class, 'destroy'])->name('.api-tokens.destroy');
        }

        // Teams...
        if (Jetstream::hasTeamFeatures()) {
            Route::get('/teams/create', [\TomatoPHP\TomatoAdmin\Http\Controllers\TeamController::class, 'create'])->name('.teams.create');
            Route::post('/teams', [\TomatoPHP\TomatoAdmin\Http\Controllers\TeamController::class, 'store'])->name('.teams.store');
            Route::get('/teams/{team}', [\TomatoPHP\TomatoAdmin\Http\Controllers\TeamController::class, 'show'])->name('.teams.show');
            Route::put('/teams/{team}', [\TomatoPHP\TomatoAdmin\Http\Controllers\TeamController::class, 'update'])->name('.teams.update');
            Route::delete('/teams/{team}', [\TomatoPHP\TomatoAdmin\Http\Controllers\TeamController::class, 'destroy'])->name('.teams.destroy');
            Route::put('/current-team', [\TomatoPHP\TomatoAdmin\Http\Controllers\CurrentTeamController::class, 'update'])->name('.current-team.update');
            Route::post('/teams/{team}/members', [\TomatoPHP\TomatoAdmin\Http\Controllers\TeamMemberController::class, 'store'])->name('.team-members.store');
            Route::get('/teams/{team}/members/{user}', [\TomatoPHP\TomatoAdmin\Http\Controllers\TeamMemberController::class, 'edit'])->name('.team-members.edit');
            Route::put('/teams/{team}/members/{user}', [\TomatoPHP\TomatoAdmin\Http\Controllers\TeamMemberController::class, 'update'])->name('.team-members.update');
            Route::delete('/teams/{team}/members/{user}', [\TomatoPHP\TomatoAdmin\Http\Controllers\TeamMemberController::class, 'destroy'])->name('.team-members.destroy');

            Route::get('/team-invitations/{invitation}', [\TomatoPHP\TomatoAdmin\Http\Controllers\TeamInvitationController::class, 'accept'])
                ->middleware(['signed'])
                ->name('.team-invitations.accept');

            Route::delete('/team-invitations/{invitation}', [\TomatoPHP\TomatoAdmin\Http\Controllers\TeamInvitationController::class, 'destroy'])
                ->name('.team-invitations.destroy');
        }
    });


    Route::get('verify-email', [\TomatoPHP\TomatoAdmin\Http\Controllers\Auth\EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', [\TomatoPHP\TomatoAdmin\Http\Controllers\Auth\VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('email/verification-notification', [\TomatoPHP\TomatoAdmin\Http\Controllers\Auth\EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
    Route::get('confirm-password', [\TomatoPHP\TomatoAdmin\Http\Controllers\Auth\ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [\TomatoPHP\TomatoAdmin\Http\Controllers\Auth\ConfirmablePasswordController::class, 'store'])->name('password.confirm.post');

    Route::put('password', [\TomatoPHP\TomatoAdmin\Http\Controllers\Auth\PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [\TomatoPHP\TomatoAdmin\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('.logout');
});
