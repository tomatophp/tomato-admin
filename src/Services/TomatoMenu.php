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

    public function __construct()
    {
        $this->menu = collect([]);
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
                $collectByGroup = $this->menu->groupBy("group")->sort();
                $this->menu = $collectByGroup;
        return $this;
    }
}
