<?php

namespace TomatoPHP\TomatoAdmin\Views;

use Illuminate\View\Component;

class MenuItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $url,
        public string $icon='bx bx-category',
        public ?string $badge=null,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('tomato-admin::components.menu-item');
    }
}
