<section>
    <header>
        <h2 class="text-lg font-medium text-zinc-900 dark:text-white">
            {{ __('Team Name') }}
        </h2>

        <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-300">
            {{ __('The team\'s name and owner information.') }}
        </p>
    </header>

    <x-splade-form class="grid grid-cols-6 gap-6" method="put" :action="route('teams.update', $team)" :default="$team" stay @success="$splade.emit('refresh-navigation-menu')">

        <!-- Team Owner Information -->
        <div class="col-span-6 mt-4">
            <x-splade-group :label="__('Team Owner')">
                <div class="flex items-center mt-2">
                    <img class="w-12 h-12 rounded-full object-cover" src="{{ $team->owner?->profile_photo_url }}" :alt="@js($team->owner?->name)">

                    <div class="ltr:ml-4 rtl:mr-4 leading-tight">
                        <div class="text-zinc-900 dark:text-white" v-text="@js($team->owner?->name)" />
                        <div class="text-zinc-700 dark:text-zinc-300 text-sm">
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


        <div class="col-span-6">
            @if($permissions['canUpdateTeam'])
                <x-tomato-admin-submit spinner :label="__('Save')" />

                <p class="text-sm text-zinc-600 dark:text-zinc-300" v-if="form.recentlySuccessful">{{ trans('tomato-admin::global.saved') }}</p>
            @endif
        </div>
    </x-splade-form>

</section>
