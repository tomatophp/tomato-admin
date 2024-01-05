<div class="flex justify-start gap-4 ml-4 rtl:mr-4">
    @if(\Laravel\Jetstream\Jetstream::hasTeamFeatures())
        <div class="flex flex-col justify-center items-center">
            <x-tomato-admin-dropdown id="team-dropdown">
                <x-slot:button>
                    <span class="inline-flex rounded-md">
                        <button type="button" class="flex gap-2 items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                            <div>
                                {{ auth()->user()->currentTeam->name }}
                            </div>

                            <div>
                                <svg class="ml-2 rtl:mr-2 rtl:-ml-0.5 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                            </svg>
                            </div>
                        </button>
                    </span>
                </x-slot:button>

                <!-- Team Management -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Manage Team') }}
                </div>

                <!-- Team Settings -->
                <x-tomato-admin-dropdown-item type="link" icon="bx bxs-cog" :href="route('admin.teams.show', auth()->user()->currentTeam)" :label="__('Team Settings')" />
                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                    <x-tomato-admin-dropdown-item type="link" icon="bx bxs-plus-circle" :href="route('admin.teams.create')" :label="__('Create New Team')" />
                @endcan
                <div class="border-t border-gray-200 dark:border-gray-600" />
                <!-- Team Switcher -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Switch Teams') }}
                </div>

                @foreach(auth()->user()->allTeams() as $team)
                    <x-splade-form method="PUT" :action="route('admin.current-team.update')" :default="['team_id' => $team->getKey()]">
                        <x-tomato-admin-dropdown-item type="button" :icon="$team->is(auth()->user()->currentTeam) ? 'bx bxs-check-circle' : 'bx bx-check-circle'" :label="$team->name" />
                    </x-splade-form>
                @endforeach
            </x-tomato-admin-dropdown>
        </div>
    @endif
    <div class="flex flex-col justify-center items-center">
        <x-tomato-admin-dropdown id="profile-dropdown">
            <x-slot:button>
                <div class="filament-dropdown-trigger cursor-pointer">
                    @php
                        $grav_url = auth()->user()->profile_photo_url;
                    @endphp
                        <!-- Profile -->
                    <div class="w-10 h-10 rounded-full bg-gray-200 bg-cover bg-center dark:bg-gray-900" style="background-image: url('{{$grav_url}}')">
                    </div>
                </div>
            </x-slot:button>

            <!-- Team Management -->
            <div class="block px-4 py-2 text-xs text-gray-400">
                {{ __('Manage Account') }}
            </div>


            <x-tomato-admin-dropdown-item type="link" icon="bx bxs-user" :href="route('admin.profile.edit')" :label="auth()->user()->name"/>
            @if(\Laravel\Jetstream\Jetstream::hasApiFeatures())
                <x-tomato-admin-dropdown-item type="link" icon="bx bxs-lock" :href="route('admin.api-tokens.index')" :label="__('API Tokens')" />
            @endif
            <div class="border-t border-gray-200 dark:border-gray-600" />
            <x-tomato-admin-dropdown-item type="button" icon="bx bxs-moon" @click.prevent="data.dark = !data.dark; $splade.refresh()"  :label="trans('tomato-admin::global.dark')"/>
            <x-tomato-admin-dropdown-item type="link" method="POST" icon="bx bx-globe" :href="route('admin.lang')"  :label="trans('tomato-admin::global.translation')"/>
            <div class="border-t border-gray-200 dark:border-gray-600" />
            <x-tomato-admin-dropdown-item danger type="link" method="POST" icon="bx bx-log-out" :href="route('logout')"  :label="trans('tomato-admin::global.logout')"/>
        </x-tomato-admin-dropdown>
    </div>
</div>
