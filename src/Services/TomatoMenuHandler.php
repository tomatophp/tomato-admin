<?php
namespace TomatoPHP\TomatoAdmin\Services;

use Illuminate\Support\Collection;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;

class TomatoMenuHandler
{
    /**
     * @var array|null
     */
    public ?Collection $menu;

    public function __construct()
    {
        $this->menu = collect([]);
    }

    /**
     * @param string $item
     * @return void
     */
    public function register(array|Menu $item): void
    {

        if(is_array($item)){
                        foreach ($item as $menuItem) {
                $this->menu->push($menuItem);
                        }
        }
        else {
            $this->menu->push($item);
        }
    }

    /**
     * @return array
     */
    public function load(): Collection
    {
        return $this->menu;
    }

    public function get(): Collection
    {
        return TomatoMenu::get();
    }
}
