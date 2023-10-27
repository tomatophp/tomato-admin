<?php

namespace TomatoPHP\TomatoAdmin\Views;

use Illuminate\View\Component;

class ActionButtons extends Component
{
    public function __construct(
        public string $table,
        public mixed $item,
        public bool $view = false,
        public bool $edit = false,
        public bool $delete = false,
    )
    {
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('tomato-admin::components.action-buttons', [
            'view' => $this->view,
            'edit' => $this->edit,
            'delete' => $this->delete,
        ]);
    }
}
