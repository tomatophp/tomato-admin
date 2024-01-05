<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('API Tokens') }}
    </x-slot:header>

    <div class="pb-12">
        <div class="mx-auto  space-y-6">
            <div class="dark:bg-gray-800 dark:text-white p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl" dusk="update-profile-information">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-white">
                                {{ __('Create API Token') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                {{ __('API tokens allow third-party services to authenticate with our application on your behalf.') }}
                            </p>
                        </header>

                        <x-splade-form :action="route('admin.api-tokens.store')" class="flex flex-col gap-4">
                            <!-- Token Name -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-splade-input name="name" autofocus label="Name" />
                            </div>

                            <!-- Token Permissions -->
                            @if(count($availablePermissions) > 0)
                                <div class="col-span-6">
                                    <x-splade-checkboxes
                                        name="permissions"
                                        label="Permissions"
                                        class="grid grid-cols-1 md:grid-cols-2 gap-1"
                                        :options="array_combine($availablePermissions, $availablePermissions)"
                                    />
                                </div>
                            @endif

                            <p class="text-sm text-gray-600 dark:text-gray-300" v-if="form.recentlySuccessful">{{ trans('tomato-admin::global.saved') }}</p>

                            <div class="mt-2">
                                <x-splade-submit :label="__('Create')" />
                            </div>
                        </x-splade-form>

                    </section>

                </div>
            </div>
            @if(count($tokens) > 0)
            <div class="dark:bg-gray-800 dark:text-white p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl" dusk="update-profile-information">
                    <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900 dark:text-white">
                                    {{ __('Manage API Tokens') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                    {{ __('You may delete any of your existing tokens if they are no longer needed.') }}
                                </p>
                            </header>

                            <div class="flex flex-col gap-4">
                                @foreach($tokens as $token)
                                    <div class="flex items-center justify-between my-4">
                                        <div class="break-all dark:text-white">
                                            {{ $token['name'] }}
                                        </div>

                                        <div class="flex items-center ml-2 gap-4">
                                            @if($token['last_used_ago'])
                                                <div class="text-sm text-gray-400">
                                                    {{ __('Last used') }} {{ $token['last_used_ago'] }}
                                                </div>
                                            @endif

                                            @if(count($availablePermissions) > 0)
                                                <Link
                                                    modal
                                                    href="{{ route('admin.api-tokens.edit', $token['id']) }}"
                                                    class="cursor-pointer ml-6 text-sm text-gray-400 underline"
                                                >
                                                    {{ __('Permissions') }}
                                                </Link>
                                            @endif

                                            <x-splade-form
                                                method="delete"
                                                :action="route('admin.api-tokens.destroy', $token['id'])"
                                                :confirm-danger="__('Delete API Token')"
                                                :confirm-text="__('Are you sure you would like to delete this API token?')"
                                                :confirm-button="__('Delete')"
                                                require-password
                                            >

                                                <button type="submit" class="cursor-pointer ml-6 text-sm text-red-500">
                                                    {{ __('Delete') }}
                                                </button>
                                            </x-splade-form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                </div>
            </div>
            @endif
        </div>
    </div>

    @if($newToken = session('flash.token'))
        <x-splade-modal :close-button="false" name="token-modal" class="!p-0">
            <x-slot:title>
                {{ __('API Token') }}
            </x-slot:title>

            <div>
                {{ __('Please copy your new API token. For your security, it won\'t be shown again.') }}
            </div>

            <div class="flex flex-col gap-4">
                <div class="flex justify-between gap-2">
                    <div class="mt-4 bg-gray-100 px-4 py-2 rounded font-mono text-sm text-gray-500 break-all w-full">
                        {{ $newToken }}
                    </div>
                    <div class="flex flex-col justify-center items-center mt-4">
                        <x-tomato-admin-copy :text="$newToken">
                            <i class="bx bx-copy"></i>
                        </x-tomato-admin-copy>
                    </div>
                </div>

                <x-tomato-admin-button secondary @click.prevent="modal.close" type="button">
                    {{ __('Cancel') }}
                </x-tomato-admin-button>
            </div>
        </x-splade-modal>

        <x-splade-script>$splade.openPreloadedModal('token-modal')</x-splade-script>
    @endif
</x-tomato-admin-layout>
