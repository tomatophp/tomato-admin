<?php

namespace TomatoPHP\TomatoAdmin\Views;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class DropdownItem extends Component
{

    public ?bool $primary =false;

    public function __construct(
        public ?string $label=null,
        public ?string $icon=null,
        public ?string $type="button",
        public ?bool $warning =false,
        public ?bool $black =false,
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
        return view('tomato-admin::components.dropdown-item');
    }
}
