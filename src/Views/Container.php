<?php

namespace TomatoPHP\TomatoAdmin\Views;

use Illuminate\View\Component;

class Container extends Component
{

    public function __construct(
        public ?string $label=null,
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('tomato-admin::components.container');
    }
}
