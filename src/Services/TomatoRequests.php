<?php

namespace TomatoPHP\TomatoAdmin\Services;

use Carbon\Carbon;
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
use ProtoneMedia\Splade\SpladeTable;
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
        mixed $table=null,
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
        if($request->has('search') && !empty($request->get('search'))){
            $query->where($request->get('searchBy')?: 'name','LIKE', '%'.$request->get('search').'%');
        }

        if($request->has('id') && !empty($request->get('id'))){
            $query->where('id',$request->get('id'));
        }

        if($request->has('paginated')){
            $paginate  = $request->get('paginated');
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
        ?string $message="Record Created Success",
        ?string $validationError="Validation Error",
        ?string $redirect=null,
        ?bool $hasMedia=false,
        ?array $collection=[],
        ?bool $api=true
    ): TomatoResponse|JsonResponse
    {
        $isAPIRequest = Str::contains('splade', \Route::current()->gatherMiddleware());
        if(count($validation)){
            $validator = Validator::make($request->all(), $validation);
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
        }

        $record = $model::create($request->all());
        if($hasMedia){
            foreach ($collection as $key=>$multi){
                if($multi){
                   if($request->has($key) && is_array($request->{$key}) && count($request->{$key})){
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
    public function get(
        Model $model,
        string $view,
        array $data=[],
        bool $hasMedia=false,
        array $collection=[],
        array $attach = [],
        ?bool $api=true,
        ?string $resource=null,
        ?Builder $query=null,
    ): View|JsonResponse
    {
        $isAPIRequest = Str::contains('splade', \Route::current()->gatherMiddleware());

        if(count($attach)){
            foreach ($attach as $key=>$value){
                $model->{$key} = $value;
            }
        }

        if($hasMedia){
            foreach ($collection as $key=>$multi) {
                if ($multi) {
                    $model->{$key} = $model->getMedia($key)->map(function ($file) {
                        return $file->getUrl();
                    });
                } else {
                    $model->{$key} = $model->getMedia($key)->first() ? $model->getMedia($key)->first()->getUrl() : null;
                }
            }

            unset($model->media);
            if($api  && (!$isAPIRequest)){
                $response = $model;
                if($resource){
                    $response = $resource::make($response);
                }
                return ApiResponse::data(
                    data: $response,
                    message: "Record Fetched Success"
                );
            }
            else {
                return view($view, array_merge([
                    "model" => $model
                ], $data));
            }
        }

        if($api  && (!$isAPIRequest)){
            $response = $model;
            if($resource){
                $response = $resource::make($response);
            }
            return ApiResponse::data(
                data: $response,
                message: "Record Fetched Success"
            );
        }
        else {
            return view($view, array_merge([
                "model" => $model
            ], $data));
        }

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
    public function update(
        Request $request,
                           Model $model,
                           ?array $validation = [],
                           ?string $message="Record Updated Success",
                           ?string $validationError="Validation Error",
                           ?string $redirect=null,
                           ?bool $hasMedia=false,
                           ?array $collection=[],
                           ?bool $api=true):TomatoResponse|JsonResponse
    {
        $isAPIRequest = Str::contains('splade', \Route::current()->gatherMiddleware());
        if(count($validation)){
            $validator = Validator::make($request->all(), $validation);
            if ($validator->fails()) {
                if($api && (!$isAPIRequest)){
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
        }
        $model->update(collect($request->all())->filter( function($value, $key) {
            return $value !== null;
        })->toArray());

        if($hasMedia){
            foreach ($collection as $key=>$multi){
                if($multi){
                    if($request->has($key) && is_array($request->{$key}) && count($request->{$key})){
                        $model->clearMediaCollection($key);
                        foreach ($request->{$key} as $item) {
                            if(!is_string($item)){
                                if($item->getClientOriginalName() === 'blob'){
                                    $model->addMedia($item)
                                        ->usingFileName(strtolower(Str::random(10).'_'.$key.'.'.$item->extension()))
                                        ->preservingOriginal()
                                        ->toMediaCollection($key);
                                }
                                else {
                                    $model->addMedia($item)
                                        ->preservingOriginal()
                                        ->toMediaCollection($key);
                                }
                            }
                        }
                    }
                }
                else{
                    if($request->hasFile($key)){
                        $model->clearMediaCollection($key);
                        if($request->{$key}->getClientOriginalName() === 'blob'){
                            $model->addMedia($request->{$key})
                                ->usingFileName(strtolower(Str::random(10).'_'.$key.'.'.$request->{$key}->extension()))
                                ->preservingOriginal()
                                ->toMediaCollection($key);
                        }
                        else {
                            $model->addMedia($request->{$key})
                                ->preservingOriginal()
                                ->toMediaCollection($key);
                        }
                    }

                }
            }
        }

        if($api  && (!$isAPIRequest)){
            return ApiResponse::data(
                data: $model,
                message: $message
            );
        }
        else {
            Toast::title($message)->success()->autoDismiss(2);
            return  TomatoResponse::make()->redirect($redirect ? redirect()->route($redirect) : redirect()->back())->record($model);
        }
    }

    /**
     * @param Model $model
     * @param string $message
     * @param string $redirect
     * @return RedirectResponse
     */
    public function destroy(
        Model $model,
        string $message,
        string $redirect,
        ?bool $hasMedia=false,
                           ?array $collection=[],
                           ?bool $api=true
    ): TomatoResponse|JsonResponse
    {
        $isAPIRequest = Str::contains('splade', \Route::current()->gatherMiddleware());

        if($hasMedia) {
            foreach ($collection as $key => $multi) {
                $model->clearMediaCollection($key);
            }
        }

        $model->delete();

        if($api  && (!$isAPIRequest)){
            return ApiResponse::data(
                data: [],
                message: $message
            );
        }
        else {
            Toast::title($message)->success()->autoDismiss(2);
            return  TomatoResponse::make()->redirect($redirect ? redirect()->route($redirect) : redirect()->back());
        }
    }
}
