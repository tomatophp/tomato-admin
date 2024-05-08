<?php

namespace TomatoPHP\TomatoAdmin\Views;

use Illuminate\View\Component;

class Navbar extends Component
{
    public function __construct(
        public bool $sidebar = true,
    )
    {
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('tomato-admin::layouts.includes.nav');
    }
}
