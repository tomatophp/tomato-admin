<?php

namespace TomatoPHP\TomatoAdmin\Views;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class Row extends Component
{


    public function __construct(
        public ?string $label=null,
        public mixed $value=null,
        public ?string $type="text",
        public ?string $href=null,
        public ?string $icon=null,
        public ?string $color=null,
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
