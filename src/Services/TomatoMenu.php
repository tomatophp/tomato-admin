<?php

namespace TomatoPHP\TomatoAdmin\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;
use TomatoPHP\TomatoAdmin\Services\Menu\TomatoMenuRegister;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu as TomatoMenuFacade;

class TomatoMenu
{

    /**
     * @var Collection
     */
    public   Collection $menu;
    public Collection $groups;

    public function __construct()
    {
        $this->menu = collect([]);
        $this->groups = collect([]);
    }

    public function loadFromSource(): static
    {
        if(class_exists(Role::class)){
            $this->menu = TomatoMenuFacade::load()->where('route', '!=', '')->filter(function ($item) {
                $permission = \Spatie\Permission\Models\Permission::where('name', $item->route)->first();
                if($permission){
                    return auth('web')->user()->can($permission->name);
                }
                else {
                    return true;
                }
            });
        }
        else {
            $this->menu = TomatoMenuFacade::load();
        }
        return $this;
    }

    /**
     * @return Collection
     */
    public static function get(): Collection
    {
        return (new static)->loadFromSource()->build()->load();
    }

    /**
     * @return Collection
     */
    public function load(): Collection
    {
        return $this->menu;
    }

    /**
     * @return $this
     */
    private function build(): static
    {
        $groups = TomatoMenuFacade::loadGroups();

        $collectHiddenGroups = $groups->filter(function ($item) {
            return $item===false;
        });

        $collectMenusByGroup = $this->menu->groupBy("group")->sortBy(function ($item) use ($groups) {
            return array_search($item->first()->group, array_keys($groups->toArray()));
        });
        if($groups->count()){
            $collectByGroup = collect([]);
            foreach ($collectMenusByGroup as $key=>$groupItem){
                foreach ($groups as $groupKey=>$icon){
                    if($key==$groupKey){
                        if($icon){
                            $collectByGroup->put($groupKey, collect([
                                "menu" => $groupItem,
                                "icon" => $icon,
                                "key" => Str::slug($groupKey),
                                "label" => $groupKey,
                            ]));
                        }
                    }
                }
            }
        }
        else {
            $collectByGroup = $collectMenusByGroup;
        }
        $this->menu = $collectByGroup;
        return $this;
    }
}
