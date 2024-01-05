<?php

namespace TomatoPHP\TomatoAdmin\Http\Controllers\Responses;

use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\FailedPasswordConfirmationResponse as FailedPasswordConfirmationResponseContract;

class FailedPasswordConfirmationResponse implements FailedPasswordConfirmationResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $message = __('The provided password was incorrect.');

        throw ValidationException::withMessages([
            'password' => [$message],
        ]);
    }
}
