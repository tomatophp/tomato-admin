<?php

namespace TomatoPHP\TomatoAdmin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Laravel\Jetstream\Jetstream;

class TermsOfServiceController extends Controller
{
    /**
     * Show the terms of service for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Splade\Response
     */
    public function show(Request $request)
    {
        $termsFile = Jetstream::localizedMarkdownPath('terms.md');

        return view('tomato-admin::pages.terms', [
            'terms' => Str::markdown(file_get_contents($termsFile)),
        ]);
    }
}
