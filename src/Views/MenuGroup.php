<?php

namespace TomatoPHP\TomatoAdmin\Views;

use Illuminate\View\Component;

class MenuGroup extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $key,
        public string $label,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('tomato-admin::components.menu-group');
    }
}
