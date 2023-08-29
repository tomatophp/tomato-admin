<?php

namespace TomatoPHP\TomatoAdmin\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Foundation\Http\FormRequest;

interface TomatoMenu
{
    /**
     * @param Request $request
     * @param string $view
     * @param string $table
     * @param array $data
     * @return View
     */
    public static function index(Request $request, string $view, string $table, array $data=[]): View;

    /**
     * @param Request $request
     * @param string $model
     * @param array $data
     * @return JsonResponse
     */
    public static function json(Request $request, string $model, array $data=[]): JsonResponse;

    /**
     * @param string $view
     * @param array $data
     * @return View
     */
    public static function create(string $view, array $data=[]): View;

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
    public static function store(FormRequest $request, string $model, string $message, string $redirect, bool $hasMedia=false, string $collection="", bool $multi = false): array;

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
