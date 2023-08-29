<?php

namespace TomatoPHP\TomatoAdmin\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoAdmin\Interfaces\TomatoBase;

class Tomato implements TomatoBase
{

    /**
     * @param Request $request
     * @param string $view
     * @param string $table
     * @param array $data
     * @return View
     */
    public static function index(Request $request, string $view, string $table, array $data=[]): View
    {
        return view($view, array_merge([
            'table' => app($table),
        ],$data));
    }

    /**
     * @param Request $request
     * @param string $model
     * @param array $data
     * @return JsonResponse
     */
    public static function json(Request $request, string $model, array $data=[],bool|int $paginate=false): JsonResponse
    {
        return response()->json([
            'model' => $paginate ? $model::paginate($paginate) : ["data"=>$model::all()->toArray()],
            'data' => $data
        ]);
    }

    /**
     * @param string $view
     * @param array $data
     * @return View
     */
    public static function create(string $view, array $data=[]): View
    {
        return view($view, $data);
    }


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
    public static function store(FormRequest $request, string $model, string $message, string $redirect, bool $hasMedia=false, string $collection="", bool $multi = false): array
    {
        $request->validated();
        $record = $model::create($request->all());

        if($hasMedia){

            if($multi){
                if(count($request->get($collection))){
                    foreach ($request->{$collection} as $item) {
                        $record->addMedia($item)
                            ->preservingOriginal()
                            ->toMediaCollection($collection);
                    }
                }
            }
            else {
                if($request->hasFile($collection)){
                    $record->addMedia($request->{$collection})
                        ->preservingOriginal()
                        ->toMediaCollection($collection);
                }
            }
        }

        Toast::title($message)->success()->autoDismiss(2);
        return [
            "redirect" => redirect()->route($redirect),
            "record" => $record
        ];
    }


    /**
     * @param Model $model
     * @param string $view
     * @param array $data
     * @param bool $hasMedia
     * @param string $collection
     * @return View
     */
    public static function get(Model $model, string $view, array $data=[], bool $hasMedia=false, string $collection="", bool $multi=false): View
    {
        if($hasMedia){
            if($multi){
                $model->{$collection} = $model->getMedia($collection)->map(function ($file) {
                    return $file->getUrl();
                });
            }
            else {
                $model->{$collection} = $model->getMedia($collection)->first() ? $model->getMedia($collection)->first()->getUrl() : null;
            }

            return view($view, array_merge([
                "model" => $model
            ], $data));
        }

        return view($view, array_merge([
            "model" => $model
        ], $data));
    }


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
    public static function update(FormRequest $request, Model $model, string $message, string $redirect, bool $hasMedia=false, string $collection="", bool $multi = false): array
    {
        $request->validated();
        $model->update($request->all());

        if($hasMedia){
            if($request->{$collection} ){
                $model->clearMediaCollection($collection);
                if($multi){
                    if($request->has($collection) && count($request->get($collection))){
                        foreach ($request->{$collection} as $item) {
                            if(!is_string($item)){
                                if($item->getClientOriginalName() === 'blob'){
                                    $model->addMedia($item)
                                        ->usingFileName(strtolower(Str::random(10).'_'.$collection.'.'.$item->extension()))
                                        ->preservingOriginal()
                                        ->toMediaCollection($collection);
                                }
                                else {
                                    $model->addMedia($item)
                                        ->preservingOriginal()
                                        ->toMediaCollection($collection);
                                }
                            }
                        }
                    }
                }
                else {
                    if($request->has($collection)){
                        if($request->{$collection}->getClientOriginalName() === 'blob'){
                            $model->addMedia($request->{$collection})
                                ->usingFileName(strtolower(Str::random(10).'_'.$collection.'.'.$request->{$collection}->extension()))
                                ->preservingOriginal()
                                ->toMediaCollection($collection);
                        }
                        else {
                            $model->addMedia($request->{$collection})
                                ->preservingOriginal()
                                ->toMediaCollection($collection);
                        }
                    }
                }
            }
        }

        Toast::title($message)->success()->autoDismiss(2);
        return [
            "redirect" => redirect()->route($redirect),
            "record" => $model
        ];
    }

    /**
     * @param Model $model
     * @param string $message
     * @param string $redirect
     * @return RedirectResponse
     */
    public static function destroy(Model $model, string $message, string $redirect): RedirectResponse
    {
        $model->delete();
        Toast::title($message)->success()->autoDismiss(2);
        return redirect()->route($redirect);
    }
}
