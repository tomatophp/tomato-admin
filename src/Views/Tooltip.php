<?php

namespace TomatoPHP\TomatoAdmin\Views;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Tooltip extends Component
{
    public $position = 'top';

    public function __construct(
        public string $text,
        public bool $left = false,
        public bool $right = false,
        public bool $top = true,
        public bool $bottom = false,
        public ?string $id=null,
    )
    {
        $this->id = Str::random(10);
        $this->position = $this->left ? 'left' : ($this->right ? 'right' : ($this->top ? 'top' : ($this->bottom ? 'bottom' : 'top')));
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('tomato-admin::components.tooltip');
    }
}
