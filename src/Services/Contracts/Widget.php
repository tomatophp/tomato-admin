<?php

namespace TomatoPHP\TomatoAdmin\Services\Contracts;

class Widget
{
    public string $title;
    public ?string $model=null;
    public ?string $counter=null;
    public ?array $query=[];
    public ?string $description=null;
    public ?string $icon=null;

    /**
     * @return static
     */
    public static function make(): static
    {
        return (new static);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array([
           "title" => $this->title ?? null,
           "model" => $this->model ?? null,
           "counter" => $this->counter ?? null,
           "query" => $this->query ?? null,
           "description" => $this->description ?? null,
           "icon" => $this->icon ?? null,
        ]);
    }


    /**
     * @param string $title
     * @return $this
     */
    public function title(string $title): static
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $model
     * @return $this
     */
    public function model(string $model): static
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @param string $counter
     * @return $this
     */
    public function counter(string $counter): static
    {
        $this->counter = $counter;
        return $this;
    }

    /**
     * @param array $query
     * @return $this
     */
    public function query(array $query): static
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function description(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param string $icon
     * @return $this
     */
    public function icon(string $icon): static
    {
        $this->icon = $icon;
        return $this;
    }

}
