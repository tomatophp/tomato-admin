<section>
    <header>
        <h2 class="text-lg font-medium text-zinc-900 dark:text-white">
            {{ __('Two Factor Authentication') }}
        </h2>

        <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-300">
            {{ __('Add additional security to your account using two factor authentication.') }}
        </p>
    </header>

    @php
        $enabled = !empty(auth()->user()->two_factor_secret);
        $showingQrCode = $enabled && !auth()->user()->two_factor_confirmed_at;
        $showingConfirmation = $showingQrCode && $confirmsTwoFactorAuthentication;
    @endphp


    <h3 class="text-lg font-medium text-zinc-900 dark:text-zinc-100">
        @if ($enabled)
            @if ($showingConfirmation)
                {{ __('Finish enabling two factor authentication.') }}
            @else
                {{ __('You have enabled two factor authentication.') }}
            @endif
        @else
            {{ __('You have not enabled two factor authentication.') }}
        @endif
    </h3>

    <div class="mt-3 max-w-xl text-sm text-zinc-600 dark:text-zinc-400">
        <p>
            {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
        </p>
    </div>

    <x-splade-data :default="['showingRecoveryCodes' => session('status') === 'recovery-codes-generated']">
        @if ($enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-zinc-600 dark:text-zinc-400">
                    <p class="font-semibold">
                        @if ($showingConfirmation)
                            {{ __('To finish enabling two factor authentication, scan the following QR code using your phone\'s authenticator application or enter the setup key and provide the generated OTP code.') }}
                        @else
                            {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application or enter the setup key.') }}
                        @endif
                    </p>
                </div>

                <div class="mt-4">
                    {!! auth()->user()->twoFactorQrCodeSvg() !!}
                </div>

                <div class="mt-4 max-w-xl text-sm text-zinc-600 dark:text-zinc-400">
                    <p class="font-semibold">
                        {{ __('Setup Key') }}: {{ decrypt(auth()->user()->two_factor_secret) }}
                    </p>
                </div>

                @if ($showingConfirmation)
                    <x-splade-form action="/admin/user/confirmed-two-factor-authentication" class="mt-4 w-1/2 space-y-4" preserve-scroll :scroll-on-error="false">
                        <x-splade-input name="code" label="Code" inputmode="numeric" autofocus autocomplete="one-time-code" />

                        <x-splade-teleport to="#confirm-two-factor-authentication">
                            {{-- This submit button requires a click handler because of the teleport. --}}
                            <x-tomato-admin-submit spinner @click="form.submit" :label="__('Confirm')" />
                        </x-splade-teleport>
                    </x-splade-form>
                @endif
            @endif

            <div v-show="data.showingRecoveryCodes">
                <div class="mt-4 max-w-xl text-sm text-zinc-600 dark:text-zinc-400">
                    <p class="font-semibold">
                        {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-zinc-100 rounded-lg">
                    @foreach (auth()->user()->recoveryCodes() as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="mt-5">
            @if (!$enabled)
                <x-splade-form action="/admin/user/two-factor-authentication" confirm require-password preserve-scroll>
                    <x-tomato-admin-submit spinner :label="__('Enable')" />
                </x-splade-form>
            @else
                <div class="flex gap-4">
                    @if ($showingConfirmation)
                        <div id="confirm-two-factor-authentication" />
                    @else
                        <x-splade-form v-if="!data.showingRecoveryCodes" action="#" confirm require-password @success="() => data.showingRecoveryCodes = true">
                            <x-tomato-admin-submit spinner secondary :label="__('Show Recovery Codes')" />
                        </x-splade-form>

                        <x-splade-form v-if="data.showingRecoveryCodes" action="/admin/user/two-factor-recovery-codes" confirm require-password preserve-scroll>
                            <x-tomato-admin-submit spinner secondary :label="__('Regenerate Recovery Codes')" />
                        </x-splade-form>
                    @endif

                    @if ($showingConfirmation)
                        <x-splade-form method="delete" action="/admin/user/two-factor-authentication" confirm require-password-once preserve-scroll>
                            <x-tomato-admin-submit spinner secondary :label="__('Cancel')" />
                        </x-splade-form>
                    @else
                        <x-splade-form method="delete" action="/admin/user/two-factor-authentication" confirm-danger require-password preserve-scroll>
                            <x-tomato-admin-submit spinner danger :label="__('Disable')" />
                        </x-splade-form>
                    @endif
                </div>
            @endif
        </div>
    </x-splade-data>

</section>
