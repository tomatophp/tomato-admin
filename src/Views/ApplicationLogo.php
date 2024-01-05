<?php

namespace TomatoPHP\TomatoAdmin\Views;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class ApplicationLogo extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('tomato-admin::components.application-logo');
    }
}
