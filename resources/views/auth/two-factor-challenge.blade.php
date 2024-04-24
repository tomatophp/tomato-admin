<x-tomato-admin-guest-layout>
    <x-slot name="header">
        {{ __('Two-factor Confirmation') }}
    </x-slot>

    <x-tomato-auth-session-status class="mb-4" />
    <div class="space-y-8">
        <x-splade-data default="{ recovery: false }">
            <div class="mb-4 text-sm text-zinc-600 dark:text-zinc-400">
                <p v-if="!data.recovery">
                    {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
                </p>

                <p v-else>
                    {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
                </p>
            </div>

            <x-splade-form :action="route('two-factor.login')">
                <div v-if="!data.recovery">
                    <x-splade-input name="code" inputmode="numeric" autofocus autocomplete="one-time-code" :label="__('Code')" />
                </div>

                <div v-if="data.recovery">
                    <x-splade-input name="recovery_code" autocomplete="one-time-code" autofocus :label="__('Recovery Code')" />
                </div>

                <div class="flex items-center justify-end mt-4 gap-4">
                    <button type="button" class="text-sm text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 underline cursor-pointer" @click.prevent="data.recovery = !data.recovery">
                    <span v-show="data.recovery">
                        {{ __('Use a recovery code') }}
                    </span>

                    <span v-show="!data.recovery">
                        {{ __('Use an authentication code') }}
                    </span>
                    </button>

                    <x-splade-submit :label="__('Log in')" />
                </div>
            </x-splade-form>

        </x-splade-data>
    </div>
</x-tomato-admin-guest-layout>

