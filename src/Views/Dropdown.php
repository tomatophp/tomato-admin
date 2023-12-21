<?php

namespace TomatoPHP\TomatoAdmin\Views;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Dropdown extends Component
{

    public function __construct(
        public ?string $label=null,
        public ?string $icon=null,
        public ?string $id=null,
    )
    {
        $this->id = Str::random(10);
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('tomato-admin::components.dropdown');
    }
}
