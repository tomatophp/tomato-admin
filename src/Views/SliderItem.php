<?php

namespace TomatoPHP\TomatoAdmin\Views;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class SliderItem extends Component
{


    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('tomato-admin::components.slider-item');
    }
}
