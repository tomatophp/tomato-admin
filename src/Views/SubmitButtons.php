<?php

namespace TomatoPHP\TomatoAdmin\Views;

use Illuminate\View\Component;

class SubmitButtons extends Component
{
    public function __construct(
        public string $table,
        public mixed $model = null,
        public bool $save = false,
        public bool $edit = false,
        public bool $cancel = false,
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
        return view('tomato-admin::components.submit-buttons', [
            'save' => $this->save,
            'edit' => $this->edit,
            'cancel' => $this->cancel,
            'delete' => $this->delete,
        ]);
    }
}
