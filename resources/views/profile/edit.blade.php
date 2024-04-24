<x-tomato-admin-layout>
    <x-slot:header>
        {{ trans('tomato-admin::global.profile.index') }}
    </x-slot:header>

    <div class="pb-12">
        <div class="mx-auto  space-y-6">
            <div class="dark:bg-zinc-800 dark:text-white p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl" dusk="update-profile-information">
                    @include('tomato-admin::profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="dark:bg-zinc-800 dark:text-white p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl" dusk="update-password">
                    @include('tomato-admin::profile.partials.update-password-form')
                </div>
            </div>

            @if(Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="dark:bg-zinc-800 dark:text-white p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl" dusk="logout-other-browser-sessions-form">
                        @include('tomato-admin::profile.partials.two-factor-authentication-form')
                    </div>
                </div>
            @endif

            <div class="dark:bg-zinc-800 dark:text-white p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl" dusk="logout-other-browser-sessions-form">
                    @include('tomato-admin::profile.partials.logout-other-browser-sessions-form')
                </div>
            </div>

            @if(Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <div class="dark:bg-zinc-800 dark:text-white p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl" dusk="delete-user">
                        @include('tomato-admin::profile.partials.delete-user-form')
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-tomato-admin-layout>
