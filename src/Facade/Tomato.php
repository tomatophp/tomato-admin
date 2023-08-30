<?php

namespace TomatoPHP\TomatoAdmin\Facade;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Facade;
use TomatoPHP\TomatoAdmin\Services\TomatoResponse;

/**
 *  @method  \Illuminate\View\View|\Illuminate\Http\JsonResponse index(Request $request,string $model,?string $view=null,?string $table=null,array $data=[],?bool $api =true,?string $resource=null,?Builder $query=null,array $filters = [])
 * @method  \Illuminate\Http\JsonResponse json(Request $request, string $model, array $data=[],bool|int $paginate=false, ?Builder $query=null,array $filters = [])
 * @method  \Illuminate\View\View create(string $view, array $data=[])
 * @method  \Illuminate\View\View|\Illuminate\Http\JsonResponse get(Model $model, string $view, array $data=[], bool $hasMedia=false, string $collection="", bool $multi=false)
 * @method  \Illuminate\View\View edit(string $view, string $model, array $data=[])
 * @method  TomatoResponse|\Illuminate\Http\JsonResponse store(Request $request, string $model,?array $validation = [], ?string $message="Record Updated Success", ?string $redirect=null, ?bool $hasMedia=false, ?array $collection=[],  ?bool $api=true)
 * @method  TomatoResponse|\Illuminate\Http\JsonResponse update(\Illuminate\Http\Request $request, string $model, string $message, string $redirect)
 * @method  \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse destroy(Model $model, string $message, string $redirect)
 */
class Tomato extends  Facade
{
    protected static function getFacadeAccessor()
    {
        return 'tomato';
    }
}
