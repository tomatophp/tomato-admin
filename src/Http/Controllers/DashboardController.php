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

    /**
     * @return View
     */
    public function profile(): View
    {
        return view('tomato-admin::profile.edit', [
            "user" => auth()->user()
        ]);
    }


    /**
     * @param ProfileUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(ProfileUpdateRequest $request): \Illuminate\Http\RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('admin.profile.edit')->with('status', 'profile-updated');
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function password(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function switchLang(Request $request){
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
        return redirect()->back();
    }

}
