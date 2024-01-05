<?php

namespace TomatoPHP\TomatoAdmin\Http\Controllers\Responses;

use Laravel\Fortify\Contracts\PasswordUpdateResponse as PasswordUpdateResponseContract;
use Laravel\Fortify\Fortify;

class RecoveryCodesGeneratedResponse implements PasswordUpdateResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        return back()->with('status', Fortify::RECOVERY_CODES_GENERATED);
    }
}
