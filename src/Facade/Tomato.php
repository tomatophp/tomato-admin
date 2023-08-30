<?php

namespace TomatoPHP\TomatoAdmin\Facade;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Facade;

/**
 *  @method static \Illuminate\View\View|\Illuminate\Http\JsonResponse index(Request $request,string $model,?string $view=null,?string $table=null,array $data=[],?bool $api =true,?string $resource=null,?Builder $query=null,array $filters = [])
 * @method static \Illuminate\Http\JsonResponse json(Request $request, string $model, array $data=[],bool|int $paginate=false, ?Builder $query=null,array $filters = [])
 * @method static \Illuminate\View\View create(string $view, array $data=[])
 * @method static \Illuminate\View\View get(Model $model, string $view, array $data=[], bool $hasMedia=false, string $collection="", bool $multi=false)
 * @method static \Illuminate\View\View edit(string $view, string $model, array $data=[])
 * @method static \Illuminate\Http\RedirectResponse store(\Illuminate\Http\Request $request, string $model, string $message, string $redirect)
 * @method static \Illuminate\Http\RedirectResponse update(\Illuminate\Http\Request $request, string $model, string $message, string $redirect)
 * @method static \Illuminate\Http\RedirectResponse destroy(Model $model, string $message, string $redirect)
 */
class Tomato extends  Facade
{
    protected static function getFacadeAccessor()
    {
        return 'tomato';
    }
}
