<?php

namespace TomatoPHP\TomatoAdmin;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;
use TomatoPHP\TomatoAdmin\Views\MarkdownEditor;
use TomatoPHP\TomatoAdmin\Views\MarkdownViewer;
use ProtoneMedia\Splade\Http\SpladeMiddleware;
use TomatoPHP\TomatoAdmin\Console\TomatoAdminInstall;
use TomatoPHP\TomatoAdmin\Console\TomatoAdminUpgrade;
use TomatoPHP\TomatoAdmin\Models\Membership;
use TomatoPHP\TomatoAdmin\Models\Team;
use TomatoPHP\TomatoAdmin\Models\TeamInvitation;
use TomatoPHP\TomatoAdmin\Providers\AuthServiceProvider;
use TomatoPHP\TomatoAdmin\Providers\FortifyServiceProvider;
use TomatoPHP\TomatoAdmin\Providers\JetstreamWithTeamsServiceProvider;
use TomatoPHP\TomatoAdmin\Services\TomatoMenuHandler;
use TomatoPHP\TomatoAdmin\Services\TomatoRequests;
use TomatoPHP\TomatoAdmin\Services\TomatoSlots;
use TomatoPHP\TomatoAdmin\Services\TomatoWidgetHandler;
use TomatoPHP\TomatoAdmin\Views\ApplicationLogo;
use TomatoPHP\TomatoAdmin\Views\AuthSessionStatus;
use TomatoPHP\TomatoAdmin\Views\Icon;
use TomatoPHP\TomatoAdmin\Views\Items;
use TomatoPHP\TomatoAdmin\Views\Search;
use TomatoPHP\TomatoAdmin\Views\ActionButtons;
use TomatoPHP\TomatoAdmin\Views\Container;
use TomatoPHP\TomatoAdmin\Views\Copy;
use TomatoPHP\TomatoAdmin\Views\Dropdown;
use TomatoPHP\TomatoAdmin\Views\DropdownItem;
use TomatoPHP\TomatoAdmin\Views\Layout;
use TomatoPHP\TomatoAdmin\Views\Aside;
use TomatoPHP\TomatoAdmin\Views\Footer;
use TomatoPHP\TomatoAdmin\Views\GuestLayout;
use TomatoPHP\TomatoAdmin\Views\Navbar;
use TomatoPHP\TomatoAdmin\Views\ProfileDropdown;
use TomatoPHP\TomatoAdmin\Views\Button;
use TomatoPHP\TomatoAdmin\Views\MenuGroup;
use TomatoPHP\TomatoAdmin\Views\MenuItem;
use TomatoPHP\TomatoAdmin\Views\Relations;
use TomatoPHP\TomatoAdmin\Views\RelationsGroup;
use TomatoPHP\TomatoAdmin\Views\Slider;
use TomatoPHP\TomatoAdmin\Views\SliderItem;
use TomatoPHP\TomatoAdmin\Views\SubmitButtons;
use TomatoPHP\TomatoAdmin\Views\TableAction;
use TomatoPHP\TomatoAdmin\Views\Tooltip;
use TomatoPHP\TomatoAdmin\Views\Widget;
use TomatoPHP\TomatoAdmin\Http\Middleware\LanguageSwitcher;
use TomatoPHP\TomatoAdmin\Views\Row;
use TomatoPHP\TomatoAdmin\Views\Submit;
use TomatoPHP\TomatoAdmin\Views\Repeater;
use TomatoPHP\TomatoAdmin\Views\Rich;
use TomatoPHP\TomatoAdmin\Views\Tel;
use TomatoPHP\TomatoAdmin\Views\Select;
use TomatoPHP\TomatoAdmin\Views\Draggable;
use TomatoPHP\TomatoAdmin\Views\Color;
use TomatoPHP\TomatoAdmin\Views\Code;
use Laravel\Fortify\Contracts;
use TomatoPHP\TomatoAdmin\Http\Controllers\Responses;

class TomatoAdminServiceProvider extends ServiceProvider
{

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        //Register config file
        $this->mergeConfigFrom(
            __DIR__.'/../config/tomato-admin.php', 'tomato-admin'
        );

        //Publish config file
        $this->publishes([
            __DIR__.'/../config/tomato-admin.php' => config_path('tomato-admin.php'),
        ], 'tomato-admin-config');

        //Register View Path
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tomato-admin');

        //Publish views
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/tomato-admin'),
        ], 'tomato-admin-views');

        //Register Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        //Load Translations
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'tomato-admin');

        //Publish Languages
        $this->publishes([
            __DIR__.'/../resources/lang' => base_path('lang/vendor/tomato-admin'),
        ], 'tomato-admin-lang');

        //Publish Views
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/tomato-admin'),
        ], 'tomato-admin-views');

        //Publish Migrations
        $this->publishes([
            __DIR__.'/../database/migrations' => base_path('database/migrations'),
        ], 'tomato-admin-migrations');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->commands([
            TomatoAdminInstall::class,
            TomatoAdminUpgrade::class
        ]);

        $this->app->bind('tomato-menu',function(){
            return new TomatoMenuHandler();
        });

        $this->app->bind('tomato-widget',function(){
            return new TomatoWidgetHandler();
        });

        $this->app->bind('tomato-slot',function(){
            return new TomatoSlots();
        });

        $this->app->bind('tomato',function(){
            return new TomatoRequests();
        });

        Config::set('fortify.middleware', ['splade','web']);
        Config::set('fortify.home', '/admin');
        Config::set('fortify.prefix', 'admin');
        Config::set('jetstream.stack', 'inertia');
        Config::set('jetstream.middleware', ['web', 'splade']);

        $this->app->register(AuthServiceProvider::class);
        $this->app->register(FortifyServiceProvider::class);
        $this->app->register(JetstreamWithTeamsServiceProvider::class);

        $this->bootSplade();

        $this->loadViewComponentsAs('tomato', [
            MarkdownEditor::class,
            MarkdownViewer::class
        ]);

    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //Add Middleware Global to Routes web
        $this->app['router']->aliasMiddleware('tomato-admin', LanguageSwitcher::class);
        $this->app['router']->pushMiddlewareToGroup('web', LanguageSwitcher::class);

        //Register View Component
        $this->loadViewComponentsAs('tomato-admin', [
            Layout::class,
            Aside::class,
            Footer::class,
            Navbar::class,
            ProfileDropdown::class,
            GuestLayout::class,
            Button::class,
            Submit::class,
            Container::class,
            Row::class,
            MenuItem::class,
            MenuGroup::class,
            Widget::class,
            Repeater::class,
            Color::class,
            Rich::class,
            Tel::class,
            Select::class,
            Code::class,
            Draggable::class,
            Relations::class,
            RelationsGroup::class,
            ActionButtons::class,
            SubmitButtons::class,
            Copy::class,
            Tooltip::class,
            Dropdown::class,
            DropdownItem::class,
            Slider::class,
            SliderItem::class,
            TableAction::class,
            Icon::class,
        ]);

        $this->loadViewComponentsAs('tomato', [
            Search::class,
            Items::class,
            ApplicationLogo::class,
            AuthSessionStatus::class
        ]);


        Jetstream::useTeamModel(Team::class);
        Jetstream::useTeamInvitationModel(TeamInvitation::class);
        Jetstream::useMembershipModel(Membership::class);

    }


    /**
     * Boot any Splade related services.
     *
     * @return void
     */
    protected function bootSplade()
    {
        $this->app->singleton(Contracts\FailedPasswordConfirmationResponse::class, Responses\FailedPasswordConfirmationResponse::class);
        $this->app->singleton(Contracts\LoginResponse::class, Responses\LoginResponse::class);
        $this->app->singleton(Contracts\LogoutResponse::class, Responses\LogoutResponse::class);
        $this->app->singleton(Contracts\PasswordConfirmedResponse::class, Responses\PasswordConfirmedResponse::class);
        $this->app->singleton(Contracts\PasswordResetResponse::class, Responses\PasswordResetResponse::class);
        $this->app->singleton(Contracts\PasswordUpdateResponse::class, Responses\PasswordUpdateResponse::class);
        $this->app->singleton(Contracts\ProfileInformationUpdatedResponse::class, Responses\ProfileInformationUpdatedResponse::class);
        $this->app->singleton(Contracts\RecoveryCodesGeneratedResponse::class, Responses\RecoveryCodesGeneratedResponse::class);
        $this->app->singleton(Contracts\RegisterResponse::class, Responses\RegisterResponse::class);
        $this->app->singleton(Contracts\SuccessfulPasswordResetLinkRequestResponse::class, Responses\SuccessfulPasswordResetLinkRequestResponse::class);
        $this->app->singleton(Contracts\TwoFactorConfirmedResponse::class, Responses\TwoFactorConfirmedResponse::class);
        $this->app->singleton(Contracts\TwoFactorDisabledResponse::class, Responses\TwoFactorDisabledResponse::class);
        $this->app->singleton(Contracts\TwoFactorEnabledResponse::class, Responses\TwoFactorEnabledResponse::class);
        $this->app->singleton(Contracts\TwoFactorLoginResponse::class, Responses\TwoFactorLoginResponse::class);
        $this->app->singleton(Contracts\VerifyEmailResponse::class, Responses\VerifyEmailResponse::class);

        SpladeMiddleware::afterOriginalResponse(function () {
            if (! session('flash.banner')) {
                return;
            }

            Splade::share('jetstreamBanner', function () {
                return [
                    'banner' => session('flash.banner'),
                    'bannerStyle' => session('flash.bannerStyle'),
                ];
            });
        });
    }
}
