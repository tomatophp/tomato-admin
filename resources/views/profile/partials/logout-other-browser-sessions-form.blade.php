<section>
    <header>
        <h2 class="text-lg font-medium text-zinc-900 dark:text-white">
            {{ __('Browser Sessions') }}
        </h2>

        <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-300">
            {{ __('Manage and log out your active sessions on other browsers and devices.') }}
        </p>
    </header>

    <x-splade-form
        method="delete"
        :action="route('other-browser-sessions.destroy')"
        :confirm="__('Log Out Other Browser Sessions')"
        :confirm-text="__('Please enter your password to confirm you would like to log out of your other browser sessions across all of your devices.')"
        :confirm-button="__('Log Out Other Browser Sessions')"
        require-password
        stay
    >
        <div class="max-w-xl text-sm text-zinc-600 dark:text-zinc-400">
            {{ __('If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.') }}
        </div>

        <!-- Other Browser Sessions -->
        @if(count($sessions) > 0)
            <div class="mt-5 space-y-6">
                @foreach($sessions as $session)
                    <div class="flex items-center">
                        <div>
                            @if($session->agent['is_desktop'])
                                <svg class="w-8 h-8 text-zinc-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                                </svg>
                            @else
                                <svg class="w-8 h-8 text-zinc-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                </svg>
                            @endif
                        </div>

                        <div class="ml-3">
                            <div class="text-sm text-zinc-600 dark:text-zinc-400">
                                {{ $session->agent['platform'] ?: 'Unknown' }} - {{ $session->agent['browser'] ?: 'Unknown' }}
                            </div>

                            <div>
                                <div class="text-xs text-zinc-500">
                                    {{ $session->ip_address }},

                                    @if($session->is_current_device)
                                        <span class="text-green-500 font-semibold">{{ __('This device') }}</span>
                                    @else
                                        <span>{{ __('Last active') }} {{ $session->last_active }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="flex items-center mt-5">
            <x-tomato-admin-submit spinner :label="__('Log Out Other Browser Sessions')" />

            <p v-if="form.recentlySuccessful" class="text-sm text-zinc-600 dark:text-zinc-300">{{ __('Done.') }}</p>
        </div>
    </x-splade-form>
</section>
