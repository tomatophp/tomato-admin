<?php

namespace TomatoPHP\TomatoAdmin\Views;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;
use ProtoneMedia\Splade\SpladeTable;

class RelationsGroup extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public array $relations=[]
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {

        return view('tomato-admin::components.relations-group');
    }
}
