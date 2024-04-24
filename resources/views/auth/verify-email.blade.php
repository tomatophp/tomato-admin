<x-tomato-admin-guest-layout>
        <x-slot name="header">
            {{ __('Two-factor Confirmation') }}
        </x-slot>

        <x-tomato-auth-session-status class="mb-4" />

    <div class="mb-4 text-sm text-zinc-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <x-splade-form action="{{ route('verification.send') }}">
            <x-splade-submit :label="__('Resend Verification Email')" />
        </x-splade-form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-zinc-600 hover:text-zinc-900">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>

</x-tomato-admin-guest-layout>
