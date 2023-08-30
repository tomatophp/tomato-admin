<?php

namespace TomatoPHP\TomatoAdmin\Views;

use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;
use ProtoneMedia\Splade\Components\Button;

class Submit extends Component
{
    public ?bool $primary =false;

    public function __construct(
        public ?string $label=null,
        public string $type='submit',
        public ?string$icon=null,
        public ?bool $secondary =false,
        public ?bool $warning =false,
        public ?bool $danger =false,
        public ?bool $success =false,
        public bool $spinner = true,
        public string $name = '',
        public $value = null,
    )
    {
                $this->primary = !$this->warning && !$this->danger && !$this->success && !$this->secondary;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('tomato-admin::components.submit');
    }

    /**
     * Returns a boolean whether there are background or text classes.
     */
    public function hasCustomStyling(ComponentAttributeBag $attributes): bool
    {
        return Button::hasCustomStyling($attributes);
    }
}
