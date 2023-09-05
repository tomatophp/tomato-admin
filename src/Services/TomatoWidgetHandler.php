<?php
namespace TomatoPHP\TomatoAdmin\Services;

use Illuminate\Support\Collection;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;
use TomatoPHP\TomatoAdmin\Services\Contracts\Widget;

class TomatoWidgetHandler
{
    /**
     * @var array|null
     */
    public ?Collection $widgets;

    public function __construct()
    {
        $this->widgets = collect([]);
    }

    /**
     * @param string $item
     * @return void
     */
    public function register(array|Widget $item): static
    {

        if(is_array($item)){
           foreach ($item as $widgetItem) {
                $this->widgets->push($widgetItem);
           }
        }
        else {
            $this->widgets->push($item);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function load(): Collection
    {
        return $this->widgets;
    }

    public function get(): Collection
    {
        return TomatoWidget::get();
    }
}
