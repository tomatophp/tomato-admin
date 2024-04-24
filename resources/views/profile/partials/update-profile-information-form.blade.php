<section>
    <header class="pb-4">
        <h2 class="text-lg font-medium text-zinc-900 dark:text-white">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-300">
            {{  __('Update your account\'s profile information and email address.') }}
        </p>
    </header>

    <x-splade-form
        method="put"
        :action="route('user-profile-information.update')"
        :default="auth()->user()"
        stay
        @success="$splade.emit('profile-information-updated')"
    >
        <div class="grid grid-cols-6 gap-6">
            <!-- Profile Photo -->
            @if(Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div class="col-span-6 sm:col-span-4">
                    <span class="block mb-1 text-zinc-700 font-sans">{{ __('Photo') }}</span>

                    <!-- Current Profile Photo -->
                    <div v-show="!form.photo" class="mt-2">
                        <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}" class="rounded-full h-20 w-20 object-cover">
                    </div>

                    <!-- New Profile Photo Preview -->
                    <div v-show="form.photo" class="mt-2">
                        <span
                            class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                            :style="'background-image: url(\'' + form.$fileAsUrl('photo') + '\');'"
                        />
                    </div>

                    <!-- Profile Photo File Input -->
                    <div class="flex mt-2 gap-2">
                        <x-splade-file name="photo" :show-filename="false">
                            {{ __('Select A New Photo') }}
                        </x-splade-file>

                        <x-splade-rehydrate on="profile-information-updated">
                            @if(auth()->user()->profile_photo_path)
                                <x-splade-link method="delete" :href="route('current-user-photo.destroy')" class="inline-block py-2 px-3 rounded-md border border-zinc-300 shadow-sm bg-white hover:bg-zinc-100 relative cursor-pointer font-medium text-zinc-700 text-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:border-indigo-300 focus:ring-indigo-200">
                                    {{ __('Remove Photo') }}
                                </x-splade-link>
                            @endif
                        </x-splade-rehydrate>
                    </div>
                </div>
            @endif

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-splade-input id="name" name="name" :label="__('Name')" autocomplete="name" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-splade-input id="email" name="email" type="email" :label="__('Email')" autocomplete="name" />
                <div id="verify-email" />
            </div>
        </div>
        <div class="mt-4">
            <p v-if="form.recentlySuccessful" class="text-sm text-zinc-600 dark:text-zinc-300">
                {{ trans('tomato-admin::global.saved') }}
            </p>

            <x-tomato-admin-submit spinner :label="__('Save')" />
        </div>
    </x-splade-form>

    @if(Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && !auth()->user()->hasVerifiedEmail())
        {{-- This section over here is teleported so we don't have a form in a form. --}}
        <x-splade-teleport to="#verify-email">
            <x-splade-form :action="route('verification.send')" stay>
                <p v-if="!form.wasSuccessful" class="text-sm mt-2 dark:text-white">
                    {{ __('Your email address is unverified.') }}

                    <button type="submit" class="underline text-sm text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-zinc-800 inline">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                <div v-if="form.wasSuccessful" class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ __('A new verification link has been sent to your email address.') }}
                </div>
            </x-splade-form>
        </x-splade-teleport>
    @endif
</section>



