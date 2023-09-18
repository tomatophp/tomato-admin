<?php

namespace TomatoPHP\TomatoAdmin;
use Illuminate\Support\ServiceProvider;
use TomatoPHP\TomatoAdmin\Console\TomatoAdminInstall;
use TomatoPHP\TomatoAdmin\Console\TomatoAdminUpgrade;
use TomatoPHP\TomatoAdmin\Services\TomatoMenuHandler;
use TomatoPHP\TomatoAdmin\Services\TomatoRequests;
use TomatoPHP\TomatoAdmin\Services\TomatoWidgetHandler;
use TomatoPHP\TomatoAdmin\Views\Container;
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
            RelationsGroup::class
        ]);

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

        $this->app->bind('tomato',function(){
            return new TomatoRequests();
        });

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
