<x-tomato-admin-guest-layout>
    <x-slot name="header">
        {{trans('tomato-admin::global.auth.register')}}
    </x-slot>
    <x-splade-form class="space-y-4">
        <x-splade-input id="name" type="text" name="name" :label="trans('tomato-admin::global.auth.name')" required autofocus />
        <x-splade-input id="email" type="email" name="email" :label="trans('tomato-admin::global.auth.email')" required />
        <x-splade-input id="password" type="password" name="password" :label="trans('tomato-admin::global.auth.password')" required autocomplete="new-password" />
        <x-splade-input id="password_confirmation" type="password" name="password_confirmation" :label="trans('tomato-admin::global.auth.password-confirmation')" required />

        @if(\Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <x-splade-checkbox name="terms">
                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-zinc-800">'.__('Terms of Service').'</a>',
                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-zinc-800">'.__('Privacy Policy').'</a>',
                ]) !!}
            </x-splade-checkbox>
        @endif


        <div class="flex items-center justify-between">
            <Link class="underline text-sm text-zinc-600 hover:text-zinc-900" href="{{ route('login') }}">
                {{ trans('tomato-admin::global.auth.already-registered') }}
            </Link>

            <x-splade-submit class="ml-4" :label="trans('tomato-admin::global.auth.register-button')" />
        </div>
    </x-splade-form>
</x-tomato-admin-guest-layout>
