<?php

namespace TomatoPHP\TomatoAdmin\Views;

use Illuminate\View\Component;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;

class Aside extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $menus = TomatoMenu::get();
        return view('tomato-admin::layouts.includes.aside', [
            "menus" => $menus
        ]);
    }
}
