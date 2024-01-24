<?php

namespace TomatoPHP\TomatoAdmin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('tomato-admin::pages.dashboard');
    }

    public function switchLang(Request $request){
        if($request->has('lang') && $request->get('lang')){
            Cookie::queue('lang', json_encode(["id" => $request->get('lang')['key'], "name" => $request->get('lang')['label']]));
            app()->setLocale($request->get('lang')['key']);
        }
        else {
            if(!Cookie::has('lang')){
                Cookie::queue('lang', json_encode(["id" => "en", "name" => "English"]));
                app()->setLocale("en");
            }

            if( json_decode(Cookie::get('lang'))->id == "en"){
                Cookie::queue('lang', json_encode(["id" => "ar", "name" => "Arabic"]));
                app()->setLocale("ar");
            }
            else {
                Cookie::queue('lang', json_encode(["id" => "en", "name" => "English"]));
                app()->setLocale("en");
            }
        }

        return redirect()->back();

    }

}
