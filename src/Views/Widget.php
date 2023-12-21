<?php

namespace TomatoPHP\TomatoAdmin\Views;

use Illuminate\View\Component;

class Widget extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title,
        public ?string $model=null,
        public ?string $counter=null,
        public ?array $query=[],
        public ?string $description=null,
        public ?string $icon=null,
        public ?string $color=null,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        if($this->model){
            $query = $this->model::query();
            if ($this->query) {
                foreach ($this->query as $key => $value) {
                    $query->where($key, $value);
                }
            }
            $this->counter = $query->count();
        }
        return view('tomato-admin::components.widget');
    }
}
