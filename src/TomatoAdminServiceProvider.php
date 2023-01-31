<?php

namespace TomatoPHP\TomatoAdmin;
use Illuminate\Support\ServiceProvider;
use TomatoPHP\TomatoAdmin\Console\TomatoAdminInstall;
use TomatoPHP\TomatoAdmin\Views\Aside;
use TomatoPHP\TomatoAdmin\Views\Footer;
use TomatoPHP\TomatoAdmin\Views\GuestLayout;
use TomatoPHP\TomatoAdmin\Views\Navbar;
use TomatoPHP\TomatoAdmin\Views\ProfileDropdown;
use TomatoPHP\TomatoPHP\Http\Middleware\LanguageSwitcher;

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
        ], 'tomato-config');

        //Register View Path
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tomato-admin');

        //Publish views
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/tomato-admin'),
        ], 'tomato-views');

        //Register Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        //Load Translations
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'tomato-admin');

        //Publish Views
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/tomato-admin'),
        ], 'tomato-views');

        //Register View Component
        $this->loadViewComponentsAs('tomato-admin', [
            \Queents\TomatoAdmin\Views\Layout::class,
            Aside::class,
            Footer::class,
            Navbar::class,
            ProfileDropdown::class,
            GuestLayout::class
        ]);

        $this->commands([
            TomatoAdminInstall::class
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
    }
}
