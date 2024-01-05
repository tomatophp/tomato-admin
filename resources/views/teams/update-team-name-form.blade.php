<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-white">
            {{ __('Team Name') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
            {{ __('The team\'s name and owner information.') }}
        </p>
    </header>

    <x-splade-form class="grid grid-cols-6 gap-6" method="put" :action="route('teams.update', $team)" :default="$team" stay @success="$splade.emit('refresh-navigation-menu')">

        <!-- Team Owner Information -->
        <div class="col-span-6">
            <x-splade-group :label="__('Team Owner')">
                <div class="flex items-center mt-2">
                    <img class="w-12 h-12 rounded-full object-cover" src="{{ $team->owner?->profile_photo_url }}" :alt="@js($team->owner?->name)">

                    <div class="ml-4 leading-tight">
                        <div class="text-gray-900 dark:text-white" v-text="@js($team->owner?->name)" />
                        <div class="text-gray-700 dark:text-gray-300 text-sm">
                            {{ $team->owner?->email }}
                        </div>
                    </div>
                </div>
            </x-splade-group>
        </div>

        <!-- Team Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-splade-input id="name" name="name" :label="__('Team Name')" :disabled="!$permissions['canUpdateTeam']" />
        </div>


        @if($permissions['canUpdateTeam'])
            <x-splade-submit :label="__('Save')" />

            <p class="text-sm text-gray-600 dark:text-gray-300" v-if="form.recentlySuccessful">{{ trans('tomato-admin::global.saved') }}</p>
        @endif
    </x-splade-form>

</section>
