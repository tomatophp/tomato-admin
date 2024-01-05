<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('Create Team') }}
    </x-slot:header>

    <div class="pb-12">
        <div class="mx-auto  space-y-6">
            <div class="dark:bg-gray-800 dark:text-white p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ __('Team Details') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                            {{ __('Create a new team to collaborate with others on projects.') }}
                        </p>
                    </header>
                    <div class="grid grid-cols-6 gap-4">
                        <div class="col-span-6">
                            <x-splade-form class="flex flex-col gap-4" :action="route('admin.teams.store')">
                                <div dusk="update-profile-information" class="flex flex-col gap-4">
                                    <div>
                                        <x-splade-group :label="__('Team Owner')" class="mt-4">
                                            <div class="flex items-center mt-2">
                                                <img class="object-cover w-12 h-12 rounded-full" src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}">

                                                <div class="ml-4 leading-tight">
                                                    <div class="text-gray-900 dark:text-white">{{ auth()->user()->name }}</div>
                                                    <div class="text-gray-700 dark:text-gray-300 text-sm">
                                                        {{ auth()->user()->email }}
                                                    </div>
                                                </div>
                                            </div>
                                        </x-splade-group>
                                    </div>

                                    <div>
                                        <x-splade-input id="name" name="name" :label="__('Team Name')" autofocus />
                                    </div>
                                </div>
                                <x-splade-submit :label="__('Create')" />
                            </x-splade-form>
                        </div>
                    </div>
                </section>


            </div>
        </div>
    </div>
</x-tomato-admin-layout>
