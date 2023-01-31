<?php

namespace TomatoPHP\TomatoAdmin\Views;

use Illuminate\View\Component;

class ProfileDropdown extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('tomato-admin::components.profile-dropdown');
    }
}
