<?php

namespace TomatoPHP\TomatoAdmin\Helpers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ApiResponse
{
    /**
     * @param $errorsArray
     * @param $code
     * @return Response|Application|ResponseFactory
     */
    public static function errors($errorsArray =null, $code=400, $message="Something Went Wrong"): JsonResponse
    {
        return response()->json(['status' => false, 'message' => $errorsArray ?? $message],$code);
    }

    /**
     * @param $data
     * @param $message
     * @param $code
     * @return Response|Application|ResponseFactory
     */
    public static function data($data, $message =null, $code=200, $meta=[]):JsonResponse
    {
        $response = ['message'=>$message ?? __("Data Retrieved Successfully"),'data' => $data,'status' => true];
        count($meta) ? $response['meta'] = $meta : null;
        return response()->json($response,$code);
    }

    /**
     * @param $message
     * @param $code
     * @return Response|Application|ResponseFactory
     */
    public static function success($message =null, $code=200):Response|Application|ResponseFactory
    {
        return response(['status' => true, 'message' => $message ?? __("Done !")],$code);
    }

    /**
     * @return Response|Application|ResponseFactory
     */
    public static function bannedMessage():Response|Application|ResponseFactory
    {
        return response(['status' => false, 'account_status' => 'banned', 'errors' => ['token' => [trans('main.account_is_banned')]]]);
    }

    /**
     * @return Response|Application|ResponseFactory
     */
    public static function emptyToken(): Response|Application|ResponseFactory
    {
        return response(['status' => false, 'errors' => ['unauthorized'=>['you are unauthorized']]],401);
    }

    /**
     * @return Response|Application|ResponseFactory
     */
    public static function emptyTokenHeader(): Response|Application|ResponseFactory
    {
        return response(['unauthorized'=>['you are unauthorized']],400);
    }
}
