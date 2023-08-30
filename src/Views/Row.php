<?php

namespace TomatoPHP\TomatoAdmin\Views;

use Illuminate\View\Component;

class Row extends Component
{


    public function __construct(
        public ?string $label=null,
        public string|array|null $value=null,
        public ?string $type="text",
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
        return view('tomato-admin::components.row');
    }
}
