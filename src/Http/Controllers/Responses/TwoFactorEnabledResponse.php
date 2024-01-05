<?php

namespace TomatoPHP\TomatoAdmin\Http\Controllers\Responses;

use Laravel\Fortify\Contracts\TwoFactorLoginResponse as TwoFactorLoginResponseContract;
use Laravel\Fortify\Fortify;

class TwoFactorEnabledResponse implements TwoFactorLoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        return back()->with('status', Fortify::TWO_FACTOR_AUTHENTICATION_ENABLED);
    }
}
