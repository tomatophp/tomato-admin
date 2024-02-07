<?php

namespace TomatoPHP\TomatoAdmin\Views;

use Illuminate\Http\Request;
use Illuminate\View\Component;

class Button extends Component
{
    public ?bool $primary =false;

    public function __construct(
        public string $type='link',
        public ?string $label=null,
        public ?string $method="get",
        public ?string$icon=null,
        public ?bool $warning =false,
        public ?bool $secondary =false,
        public ?bool $danger =false,
        public ?bool $success =false,
    )
    {
        $this->primary = !$this->warning && !$this->danger && !$this->success && !$this->secondary;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $checkPermission = function (array $data) {
            if(isset($data['attributes']) && isset($data['attributes']['href'])){
                $route = \Route::getRoutes()->match(Request::create($this->attributes->getAttributes()['href']))->getName();
                if(class_exists(\Spatie\Permission\Models\Role::class)){
                    $permission = \Spatie\Permission\Models\Permission::where('name', $route)->first();
                }
                else {
                    $permission = null;
                }

                if($permission && auth('web')->user() && auth('web')->user()->can($permission->name)){
                    return true;
                }
                else if(!$permission){
                    return true;
                }
                else {
                    return false;
                }
            }
            else {
                return true;
            }
        };

        if($checkPermission){
            return view('tomato-admin::components.button');
        }
        else {
            return '';
        }
    }
}
