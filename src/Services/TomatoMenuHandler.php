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
    public ?Collection $groups;

    public function __construct()
    {
        $this->menu = collect([]);
        $this->groups = collect([]);
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

    public function groups(array $groups): static
    {
        $this->groups = collect($groups);
        return $this;
    }

    public function loadGroups(): Collection
    {
        return $this->groups;
    }

    public function get(): Collection
    {
        return TomatoMenu::get();
    }
}
