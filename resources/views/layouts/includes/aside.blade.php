<div
        v-cloak
        v-show="data.makeMenuHide"
        @click.prevent="data.makeMenuHide = !data.makeMenuHide"
        class="fixed inset-0 z-20 w-full h-full filament-sidebar-close-overlay lg:hidden"
>

</div>
<aside
        :class="{
            'hidden': !data.makeMenuHide,
            'w-24': data.makeMenuMin,
            'w-72': !data.makeMenuMin
        }"
        class="
                    lg:flex
                    filament-sidebar-open
                    translate-x-0
                    max-w-[20em]
                    lg:max-w-[var(--sidebar-width)]
                    filament-sidebar
                    fixed
                    inset-y-0
                    left-0
                    rtl:left-auto
                    rtl:right-0
                    z-20
                    flex
                    flex-col
                    h-screen
                    overflow-hidden
                    shadow-2xl
                    transition-all
                    bg-zinc-800
                    lg:z-0
                    dark:bg-zinc-800
                    filament-sidebar-open
                    translate-x-0
                    max-w-[20em]
                    lg:max-w-[var(--sidebar-width)]
                ">

    <header
            class="
                bg-zinc-900
                filament-sidebar-header
                h-[4rem]
                shrink-0
                px-6 flex items-center dark:border-zinc-700"
    >
        @if(count(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getLogoSection()))
            @foreach(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getLogoSection() as $item)
                @include($item)
            @endforeach
        @else
        <Link
                href="{{route('admin')}}"
                class="block w-fulls font-bold"
                v-show="true"
                data-turbo="false"
                style=""
        >
            <x-tomato-application-logo class="block h-9 w-auto fill-current text-primary-500" />
        </Link>
        @endif
    </header>


    <!-- Search -->
    @if(config('tomato-admin.global_search'))
    <div class="my-4 px-6" v-show="!data.makeMenuMin">
        <div class="relative">
            <div class="filament-global-search-input">
                <label for="globalSearchInput" class="sr-only">
                    {{trans('tomato-admin::global.search')}}
                </label>

                <div class="relative group max-w-md">
                <span class="absolute inset-y-0 left-0 flex items-center justify-center w-10 h-10 text-zinc-500 pointer-events-none group-focus-within:text-primary-500 dark:text-zinc-400">
                    <svg  class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <svg v-if="false" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="animate-spin w-5 h-5">
                        <path opacity="0.2" fill-rule="evenodd" clip-rule="evenodd" d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill="currentColor"></path>
                        <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z" fill="currentColor"></path>
                    </svg>
                </span>
                    <x-splade-form :default="[
                    'filter' => [
                        'global' => request()->get('filter')['global'] ?? null
                    ]
                ]"  method="GET" action="{{config('tomato-admin.global_search_route') ?: url()->current()}}">
                        <input  id="globalSearchInput" v-model="form.filter['global']" placeholder="{{trans('tomato-admin::global.search')}}" type="search" autocomplete="off" class="block w-full h-10 pl-10 bg-zinc-400/10 text-zinc-100 placeholder-zinc-200 border-transparent transition duration-75 rounded-lg focus:bg-zinc-800 focus:placeholder-zinc-600 focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 dark:bg-zinc-700 dark:text-zinc-200 dark:placeholder-zinc-600">
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(\Laravel\Jetstream\Jetstream::hasTeamFeatures())
        <div v-show="!data.makeMenuMin" class="my-2 border-t border-zinc-700"></div>
        <div v-show="!data.makeMenuMin" class="flex flex-col justify-center items-center">
            <x-tomato-admin-dropdown class="mt-2" id="team-dropdown">
                <x-slot:button>
                    <div class="flex justify-start gap-4 w-full mx-4" v-show="!data.makeMenuMin">
                        <div>
                            <div class="w-14 h-14 rounded-lg bg-gray-200 bg-cover bg-center dark:bg-gray-900" style="background-image: url('https://ui-avatars.com/api/?name={{auth()->user()->currentTeam ? auth()->user()->currentTeam->name : __('No Team')}}')">
                            </div>
                        </div>
                        <div class="flex flex-col items-center justify-center">
                            <div class="flex flex-col justify-start items-start">
                                <p class="text-white text-zinc-400">{{ __('Current Team') }}</p>
                                <h6 class="text-lg text-white font-medium">
                                    @if(auth()->user()->currentTeam)
                                        {{ auth()->user()->currentTeam?->name }}
                                    @else
                                        {{ __('No Team')}}
                                    @endif
                                </h6>
                            </div>
                        </div>
                    </div>
                </x-slot:button>

                @if(auth()->user()->currentTeam)
                    <!-- Team Management -->
                    <div class="block px-4 py-2 text-xs text-zinc-400">
                        {{ __('Manage Team') }}
                    </div>


                    <!-- Team Settings -->
                    <x-tomato-admin-dropdown-item type="link" icon="bx bxs-cog" :href="route('admin.teams.show', auth()->user()->currentTeam)" :label="__('Team Settings')" />
                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-tomato-admin-dropdown-item type="link" icon="bx bxs-plus-circle" :href="route('admin.teams.create')" :label="__('Create New Team')" />
                    @endcan
                    <div class="border-t border-zinc-200 dark:border-zinc-600" />
                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-zinc-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach(auth()->user()->allTeams() as $team)
                        <x-splade-form method="PUT" :action="route('admin.current-team.update')" :default="['team_id' => $team->getKey()]">
                            <x-tomato-admin-dropdown-item type="button" :icon="$team->is(auth()->user()->currentTeam) ? 'bx bxs-check-circle' : 'bx bx-check-circle'" :label="$team->name" />
                        </x-splade-form>
                    @endforeach
                @else
                    <!-- Team Management -->
                    <div class="block px-4 py-2 text-xs text-zinc-400">
                        {{ __('Manage Team') }}
                    </div>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-tomato-admin-dropdown-item type="link" icon="bx bxs-plus-circle" :href="route('admin.teams.create')" :label="__('Create New Team')" />
                    @endcan
                @endif

            </x-tomato-admin-dropdown>
        </div>
    @endif
    <div v-show="!data.makeMenuMin" class="my-2 border-t border-zinc-700"></div>


    <nav class="pb-6 overflow-y-auto filament-sidebar-nav" @preserveScroll('sidebar')>
        <div>
            @include('tomato-admin::layouts.includes.menu')
        </div>
    </nav>
</aside>
