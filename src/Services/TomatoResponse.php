<?php

namespace TomatoPHP\TomatoAdmin\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\View;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoAdmin\Helpers\ApiResponse;
use TomatoPHP\TomatoAdmin\Interfaces\TomatoBase;
use Illuminate\Http\Response;

class TomatoResponse
{
    public RedirectResponse $redirect;
    public ?Model $record=null;

    public static function make(){
        return new self();
    }

    public function redirect(RedirectResponse $redirect): static
    {
        $this->redirect = $redirect;
        return $this;
    }

    public function record(Model $record): static
    {
        $this->record = $record;
        return $this;
    }
}
