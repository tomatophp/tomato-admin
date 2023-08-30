<?php

namespace TomatoPHP\TomatoAdmin\Views;

use Illuminate\View\Component;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;

class Button extends Component
{
    public function __construct(
        public string $type='link',
        public ?string $label=null,
        public ?string$icon=null,
        public ?bool $primary =false,
        public ?bool $warning =false,
        public ?bool $danger =false,
        public ?bool $success =false,
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
        return view('tomato-admin::components.button');
    }
}
