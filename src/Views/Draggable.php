<?php

namespace TomatoPHP\TomatoAdmin\Views;

use Illuminate\View\Component;

class Draggable extends Component
{

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $name = '',
        public string $prepend = '',
        public int $levels = 0,
        public array $options = [],
        public string $type = 'draggable',
        public string $url = '',
        public string $orderBy = '',
        public string $append = '',
        public string $help = '',
        public bool $alwaysEnablePrepend = false,
        public bool $alwaysEnableAppend = false,
        public bool $disabled = false,
    ) {
    }

    /**
     * Returns a boolean whether the input type is 'hidden'.
     *
     * @return bool
     */
    public function isHidden(): bool
    {
        return $this->type === 'hidden';
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('tomato-admin::components.draggable');
    }
}
