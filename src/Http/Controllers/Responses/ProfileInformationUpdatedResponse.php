<?php

namespace TomatoPHP\TomatoAdmin\Http\Controllers\Responses;

use Laravel\Fortify\Contracts\ProfileInformationUpdatedResponse as ProfileInformationUpdatedResponseContract;
use Laravel\Fortify\Fortify;

class ProfileInformationUpdatedResponse implements ProfileInformationUpdatedResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        return back()->with('status', Fortify::PROFILE_INFORMATION_UPDATED);
    }
}
