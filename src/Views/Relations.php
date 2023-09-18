<?php

namespace TomatoPHP\TomatoAdmin\Views;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;
use ProtoneMedia\Splade\SpladeTable;

class Relations extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Model $model,
        public string $table,
        public string $name,
        public ?string $path=null,
        public ?string $view=null,
        public bool $show=true,
        public bool $edit=true,
        public bool $delete=true,
    )
    {
        $this->path = $this->path ?? $this->model->{$this->name}()?->first()?->getTable() ?: $this->name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {

        return view($this->view ?: 'tomato-admin::components.relations',[
            "query" => (new $this->table($this->model->{$this->name}()))
        ]);
    }
}
