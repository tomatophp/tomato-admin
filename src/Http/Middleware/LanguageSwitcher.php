<?php

namespace TomatoPHP\TomatoAdmin\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LanguageSwitcher extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        if(Cookie::get('lang')){
            $lang = json_decode(Cookie::get('lang'));
            app()->setLocale($lang->id);
        }
        else {
            Cookie::queue('lang', json_encode([
                'id' => config('app.locale'),
                'name' => config('app.locale') === 'en' ? 'English' : 'Arabic'
            ])) ;
        }

        return $next($request);
    }
}
