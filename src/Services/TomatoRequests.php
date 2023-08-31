<?php

namespace TomatoPHP\TomatoAdmin\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoAdmin\Helpers\ApiResponse;
use TomatoPHP\TomatoAdmin\Interfaces\TomatoBase;
use Illuminate\Http\Response;

class TomatoRequests
{

        private  $sorting = 'desc';
    /**
     * @param Request $request
     * @param string $view
     * @param string $table
     * @param array $data
     * @return View
     */
    public function index(
        Request $request,
        string $model,
        ?string $view=null,
        ?string $table=null,
        array $data=[],
        ?bool $api =true,
        ?string $resource=null,
        ?Builder $query=null,
        array $filters = []
    ): View| JsonResponse
    {
        if(!$query){
            $query = $model::query();
        }
        if(count($filters)){
            foreach ($filters as $key){
                if($request->has($key) && $request->get($key) !== null) {
                    $query->where($key, $request->get($key));
                }
            }
        }

        $query->orderBy('id', $this->sorting);

        $isAPIRequest = Str::contains('splade', \Route::current()->gatherMiddleware());
        if((!$isAPIRequest) && $api ){
            $response = $query->paginate(10);
            if($resource){
                $response = $resource::collection($response);
            }
            return ApiResponse::data(
                data: $response,
                meta: $data
            );
        }
        elseif((!$isAPIRequest) && (!$api )){
                        abort(404);
        }
        else {
            return view($view, array_merge([
                'table' => (new $table($query)),
            ],$data));
        }
    }

    /**
     * @param Request $request
     * @param string $model
     * @param array $data
     * @return JsonResponse
     */
    public function json(
        Request $request,
        string $model,
        array $data=[],
        bool|int $paginate=false,
        ?Builder $query=null,
        array $filters = []
    ): JsonResponse
    {
        if(!$query){
            $query = $model::query();
        }
        if(count($filters)){
            foreach ($filters as $key){
                if($request->has($key) && $request->get($key) !== null) {
                    $query->where($key, $request->get($key));
                }
            }
        }

        $query->orderBy('id', $this->sorting);

                        $response = $paginate ? $query->paginate($paginate) : $query->get();
        return ApiResponse::data(data: $response);
    }

    /**
     * @param string $view
     * @param array $data
     * @return View
     */
    public function create(string $view, array $data=[]): View
    {
        return view($view, $data);
    }


    /**
     * @param Request $request
     * @param string $model
     * @param string $message
     * @param string $redirect
     * @param bool $hasMedia
     * @param string $collection
     * @param bool $multi
     * @return array
     */
    public function store(
        Request $request,
        string $model,
        ?array $validation = [],
        ?string $message="Record Updated Success",
        ?string $validationError="Validation Error",
        ?string $redirect=null,
        ?bool $hasMedia=false,
        ?array $collection=[],
        ?bool $api=true
    ): TomatoResponse|JsonResponse
    {
        $validator = Validator::make($request->all(), $validation);
        $isAPIRequest = Str::contains('splade', \Route::current()->gatherMiddleware());
        if ($validator->fails()) {
            if($api  && (!$isAPIRequest)){
                return ApiResponse::errors(
                    message: $validationError,
                    errorsArray: $validator->errors()
                );
            }
            else {
                Toast::danger($validationError)->autoDismiss(2);
                $validator->validate();
            }
        }

        $record = $model::create($request->all());
        if($hasMedia){
            foreach ($collection as $key=>$multi){
                                if($multi){
                                    if(is_array($request->{$key}) && count($request->{$key})){
                                        foreach ($request->{$key} as $item) {
                                            $record->addMedia($item)
                                                ->preservingOriginal()
                                                ->toMediaCollection($key);
                                        }
                                    }
                                }
                else{
                                    if($request->hasFile($key)){
                                        $record->addMedia($request->{$key})
                                            ->preservingOriginal()
                                            ->toMediaCollection($key);
                                    }
                                }
            }
        }

        if($api  && (!$isAPIRequest)){
            return ApiResponse::data(
                data: $record,
                message: $message
            );
        }
        else {
            Toast::title($message)->success()->autoDismiss(2);
            return  TomatoResponse::make()->redirect($redirect ? redirect()->route($redirect) : redirect()->back())->record($record);
        }

    }


    /**
     * @param Model $model
     * @param string $view
     * @param array $data
     * @param bool $hasMedia
     * @param string $collection
     * @return View
     */
    public function get(Model $model, string $view, array $data=[], bool $hasMedia=false, string $collection="", bool $multi=false): View
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
    public function update(Request $request, Model $model, string $message, string $redirect, bool $hasMedia=false, string $collection="", bool $multi = false): array
    {
//        $request->validated();
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
    public function destroy(Model $model, string $message, string $redirect): RedirectResponse
    {
        $model->delete();
        Toast::title($message)->success()->autoDismiss(2);
        return redirect()->route($redirect);
    }
}
