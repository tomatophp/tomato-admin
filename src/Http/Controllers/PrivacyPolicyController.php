<?php

namespace TomatoPHP\TomatoAdmin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Laravel\Jetstream\Jetstream;

class PrivacyPolicyController extends Controller
{
    /**
     * Show the privacy policy for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Splade\Response
     */
    public function show(Request $request)
    {
        $policyFile = Jetstream::localizedMarkdownPath('policy.md');

        return view('tomato-admin::pages.policy', [
            'policy' => Str::markdown(file_get_contents($policyFile)),
        ]);
    }
}
