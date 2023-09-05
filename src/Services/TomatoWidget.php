<?php

namespace TomatoPHP\TomatoAdmin\Services;

use Illuminate\Support\Collection;
use TomatoPHP\TomatoAdmin\Facade\TomatoWidget as TomatoWidgetFacade;

class TomatoWidget
{

    public Collection $widgets;

    public function loadFromSource(): static
    {
        $this->widgets = TomatoWidgetFacade::load();
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
        return $this->widgets;
    }

    /**
     * @return $this
     */
    private function build(): static
    {
        $this->widgets = $this->widgets;
        return $this;
    }
}
