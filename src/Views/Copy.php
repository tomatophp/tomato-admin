<?php

namespace TomatoPHP\TomatoAdmin\Views;

use Illuminate\View\Component;

class Copy extends Component
{

    public function __construct(
        public string $text,
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
        return view('tomato-admin::components.clipboard');
    }
}
