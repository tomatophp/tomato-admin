<?php

namespace TomatoPHP\TomatoAdmin\Views;

use Illuminate\View\Component;

class Footer extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('tomato-admin::layouts.includes.footer');
    }
}
