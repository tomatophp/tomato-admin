<?php

namespace TomatoPHP\TomatoAdmin\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Foundation\Http\FormRequest;

interface TomatoBase
{
    /**
     * @param Request $request
     * @param string $view
     * @param string $table
     * @param array $data
     * @return View
     */
    public function index(Request $request,string $model,  ?string $view=null, ?string $table=null, array $data=[],?bool $api =true,?Builder $query=null, array $filters = []): View | JsonResponse;

    /**
     * @param Request $request
     * @param string $model
     * @param array $data
     * @return JsonResponse
     */
    public function json(Request $request, string $model, array $data=[]): JsonResponse;

    /**
     * @param string $view
     * @param array $data
     * @return View
     */
    public function create(string $view, array $data=[]): View;

    /**
     * @param FormRequest $request
     * @param string $model
     * @param string $message
     * @param string $redirect
     * @param bool $hasMedia
     * @param string $collection
     * @param bool $multi
     * @return array
     */
    public function store(FormRequest $request, string $model, string $message, string $redirect, bool $hasMedia=false, string $collection="", bool $multi = false): array;

    /**
     * @param Model $model
     * @param string $view
     * @param array $data
     * @param bool $hasMedia
     * @param string $collection
     * @return View
     */
    public static function get(Model $model, string $view, array $data=[], bool $hasMedia=false, string $collection=""): View;

    /**
     * @param FormRequest $request
     * @param Model $model
     * @param string $message
     * @param string $redirect
     * @param bool $hasMedia
     * @param string $collection
     * @param bool $multi
     * @return array
     */
    public static function update(FormRequest $request, Model $model, string $message, string $redirect, bool $hasMedia=false, string $collection="", bool $multi = false): array;

    /**
     * @param Model $model
     * @param string $message
     * @param string $redirect
     * @return RedirectResponse
     */
    public static function destroy(Model $model, string $message, string $redirect): RedirectResponse;
}
