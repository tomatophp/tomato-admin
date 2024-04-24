<x-tomato-admin-guest-layout>
    <x-slot name="header">
        {{ __('Login') }}
    </x-slot>

    <x-tomato-auth-session-status class="mb-4" />
    <div class="space-y-8">
        <x-splade-form class="space-y-4">
            <div class="grid grid-cols-1 gap-6 filament-forms-component-container">
                <x-splade-input id="email" type="email" name="email" :label="__('Email')" required autofocus />
                <x-splade-input id="password" type="password" name="password" :label="__('Password')" required autocomplete="current-password" />
                <x-splade-checkbox id="remember_me" name="remember" :label="__('Remember me')" />
            </div>

            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <Link class="underline text-sm text-zinc-600 dark:text-zinc-300 dark:hover:text-zinc-500 hover:text-zinc-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </Link>
                @endif

                <x-splade-submit class="ml-3" :label="__('Log in')" />
            </div>
        </x-splade-form>
    </div>
</x-tomato-admin-guest-layout>
