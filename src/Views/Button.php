<?php

namespace TomatoPHP\TomatoAdmin\Views;

use Illuminate\View\Component;

class Button extends Component
{
    public ?bool $primary =false;

    public function __construct(
        public string $type='link',
        public ?string $label=null,
        public ?string $method="get",
        public ?string$icon=null,
        public ?bool $warning =false,
        public ?bool $secondary =false,
        public ?bool $danger =false,
        public ?bool $success =false,
    )
    {
        $this->primary = !$this->warning && !$this->danger && !$this->success && !$this->secondary;
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
