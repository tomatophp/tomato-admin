<?php

namespace TomatoPHP\TomatoAdmin\Facade;

use Illuminate\Support\Facades\Facade;
use TomatoPHP\TomatoAdmin\Views\Widget;

/**
 *  @method static \Illuminate\Support\Collection get()
 * @method static \Illuminate\Support\Collection load()
 * @method static \TomatoPHP\TomatoAdmin\Services\TomatoWidget register(array|Widget $item)
 */
class TomatoWidget extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'tomato-widget';
    }
}
