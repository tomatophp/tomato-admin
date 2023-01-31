<?php

namespace TomatoPHP\TomatoAdmin\Views;

use Illuminate\View\Component;
use Queents\TomatoPHP\Services\Menu\MenuHandler;

class Aside extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $menus = MenuHandler::get()['dashboard'] ?? [];
        return view('tomato-admin::layouts.includes.aside', [
            "menus" => $menus
        ]);
    }
}
