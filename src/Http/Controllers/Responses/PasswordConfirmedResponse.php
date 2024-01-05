<?php

namespace TomatoPHP\TomatoAdmin\Http\Controllers\Responses;

use Laravel\Fortify\Contracts\PasswordConfirmedResponse as PasswordConfirmedResponseContract;
use Laravel\Fortify\Fortify;

class PasswordConfirmedResponse implements PasswordConfirmedResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        return redirect()->intended(Fortify::redirects('password-confirmation'));
    }
}
