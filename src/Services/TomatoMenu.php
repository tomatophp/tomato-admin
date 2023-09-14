<?php

namespace TomatoPHP\TomatoAdmin\Services;

use Illuminate\Support\Collection;
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
        $this->menu = TomatoMenuFacade::load();
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
        $collectByGroup = $this->menu->whereNotIn('group',  array_keys($collectHiddenGroups->toArray()))->groupBy("group")->sortBy(function ($item) use ($groups) {
            return array_search($item->first()->group, array_keys($groups->toArray()));
        });
        $this->menu = $collectByGroup;
        return $this;
    }
}
