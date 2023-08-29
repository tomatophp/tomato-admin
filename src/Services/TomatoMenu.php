<?php

namespace TomatoPHP\TomatoAdmin\Services;

use Illuminate\Support\Collection;
use TomatoPHP\TomatoAdmin\Services\Menu\TomatoMenuRegister;

class TomatoMenu
{

    /**
     * @var array
     */
    public array $children = [];

    /**
     * @var Collection
     */
    public  static Collection $menu;

    public function __construct()
    {
        static::$menu = collect([]);
    }

    public static function register(string $item): void
    {
        self::$menu[] = $item;
    }

    /**
     * @return array
     */
    public static function loadMenus(): Collection
    {
        return self::$menu;
    }

    /**
     * @return Collection
     */
    public static function get(): Collection
    {
        //Make $this->menu collection
        return (new static)->menus()->build()->load();
    }

    /**
     * @return Collection
     */
    public function load(): Collection
    {
        return static::$menu;
    }

    /**
     * @return $this
     */
    private function menus(): static
    {
        $providerMenu = static::loadMenus();
        $menusClasses = array_merge(config('tomato-admin.menus'), $providerMenu->toArray());
        foreach($menusClasses as $class){
            $this->children[] = $class;
        }

        return $this;
    }

    /**
     * @return $this
     */
    private function build(): static
    {
        static::$menu = collect();
        foreach ($this->children as $menu){
            $menuGroup = app($menu)->group;
            $menuName = app($menu)->menu;
            $menuItems = app($menu)->handler();

            if(!static::$menu->has($menuName)){
                static::$menu->put($menuName, collect([]));
            }

            $getGroup = static::$menu[$menuName]->where('label', $menuGroup)->first();
            if($getGroup){
                foreach($menuItems as $menuItemValue){
                    $getGroup['items']->push($menuItemValue);
                }
            }
            else {
                static::$menu[$menuName]->put($menuGroup, collect([
                    "label" => $menuGroup,
                    "items" => collect($menuItems)
                ]));
            }
        }

        return $this;
    }
}
