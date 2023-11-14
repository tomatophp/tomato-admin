<?php

namespace TomatoPHP\TomatoAdmin\Views;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class Slider extends Component
{

    public ?string $position = "vertical";

    public function __construct(
        public ?string $type="gallery",
        public ?bool $horizontal=false,
        public ?array $images=[],
        public ?int $items=1,
    )
    {
        $this->position = $this->horizontal ? "horizontal" : "vertical";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('tomato-admin::components.slider');
    }
}
