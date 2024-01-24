<header class="
                    filament-main-topbar
                    sticky
                    top-0
                    z-10
                    flex
                    h-16
                    w-full
                    shrink-0
                    items-center
                    border-b
                    border-gray-100
                    bg-white
                    dark:bg-gray-800
                    dark:border-gray-700
                ">
    <div class="flex items-center w-full px-2 sm:px-4 md:px-6 lg:px-8">
        <!-- hide button -->
        <button
                class="
                            filament-sidebar-open-button
                            shrink-0
                            flex
                            items-center
                            justify-center
                            w-10
                            h-10
                            transition
                            text-primary-500
                            rounded-full
                            hover:bg-gray-500/5
                            focus:bg-primary-500/10
                            focus:outline-none
                            lg:z-10
                            lg:hover:bg-white
                            lg:focus:bg-white
                            lg:hover:text-gray-600
                            lg:focus:text-gray-600
                            lg:-ml-[44px]
                            lg:w-6
                            lg:h-6
                            lg:text-gray-500
                            lg:bg-white
                            lg:shadow
                            lg:dark:bg-gray-900
                            lg:dark:hover:text-gray-400
                            lg:dark:focus:text-gray-400
                            lg:mr-4
                            rtl:lg:ml-4
                            rtl:lg:-mr-[44px]

                        "

        >
            <div
                    @click.prevent="data.makeMenuMin = !data.makeMenuMin"
                    class="relative lg:absolute invisible lg:visible"
            >
                @if(app()->getLocale() === 'ar')
                    <x-heroicon-o-arrow-small-right class="w-4 h-4 text-primary-500" v-if="!data.makeMenuMin" />
                    <x-heroicon-o-arrow-small-left class="w-4 h-4 text-primary-500" v-else/>
                @else
                    <x-heroicon-o-arrow-small-left class="w-4 h-4 text-primary-500" v-if="!data.makeMenuMin" />
                    <x-heroicon-o-arrow-small-right class="w-4 h-4 text-primary-500" v-else/>
                @endif
            </div>

            <div
                    class="relative lg:absolute visible lg:invisible"
                    @click.prevent="data.makeMenuHide = !data.makeMenuHide"
            >
                <x-heroicon-o-bars-3 class="w-6 h-6"/>
            </div>
        </button>
        <button
            class="
                  flex
                            items-center
                            justify-center
                            mx-2
                            lg:mx-0
                        ">
            <i class="bx bx-fullscreen" id="fullScreen"></i>
        </button>

        @if(\Laravel\Jetstream\Jetstream::hasTeamFeatures())
            <div class="flex flex-col justify-center items-center mx-4">
                <x-tomato-admin-dropdown id="team-dropdown">
                    <x-slot:button>
                    <span class="inline-flex rounded-md">
                        <button type="button" class="flex gap-2 items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                            <div>
                                @if(auth()->user()->currentTeam)
                                    {{ auth()->user()->currentTeam?->name }}
                                @else
                                    {{ __('No Team')}}
                                @endif
                            </div>

                            <div>
                                <svg class="ml-2 rtl:mr-2 rtl:-ml-0.5 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                            </svg>
                            </div>
                        </button>
                    </span>
                    </x-slot:button>

                    @if(auth()->user()->currentTeam)
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
                    @else
                        <!-- Team Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Team') }}
                        </div>

                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                            <x-tomato-admin-dropdown-item type="link" icon="bx bxs-plus-circle" :href="route('admin.teams.create')" :label="__('Create New Team')" />
                        @endcan
                    @endif

                </x-tomato-admin-dropdown>
            </div>
        @endif

        <div class="flex items-center justify-between flex-1">

            <!-- breadcrumbs -->
            <div class="flex-1">
                @foreach(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getNavLeftSide() as $item)
                    @include($item)
                @endforeach
            </div>

{{--            <x-tomato-admin-dropdown-item type="button" icon="bx bxs-moon" @click.prevent="data.dark = !data.dark; $splade.refresh()"  :label="trans('tomato-admin::global.dark')"/>--}}
{{--            <x-tomato-admin-dropdown-item type="link" method="POST" icon="bx bx-globe" :href="route('admin.lang')"  :label="trans('tomato-admin::global.translation')"/>--}}

            {{-- Dark Mode Button --}}
            <div>
                <div class="filament-notifications pointer-events-none fixed inset-4 z-50 mx-auto flex justify-end gap-3 items-end flex-col-reverse" role="status">
                </div>

                <!-- Notifications -->
                <div>
                    <!-- Open Notification Modal -->
                    <div
                        title="filament::layout.database_notifications"
                        type="button"
                        class="filament-icon-button flex items-center justify-center rounded-full relative hover:bg-gray-500/5 focus:outline-none text-primary-500 focus:bg-primary-500/10 dark:hover:bg-gray-300/5 w-10 h-10 ml-4 -mr-1">
                            <span class="sr-only">

                            </span>

                        @php $langs = collect(config('tomato-admin.langs')) @endphp
                        <x-tomato-admin-dropdown>
                            <x-slot:button>
                                <div>
                                    {{ isset($langs->where('key', app()->getLocale())->first()['flag']) ? $langs->where('key', app()->getLocale())->first()['flag'] : __('Lang') }}
                                </div>
                            </x-slot:button>

                            @foreach($langs as $lang)
                                <Link href="{{route('admin.lang', ['lang' => $lang])}}" method="POST"  class="@if($lang['key'] === app()->getLocale())  text-primary-600 dark:text-primary-200 hover:text-gray-500  @else text-gray-600 dark:text-gray-200 hover:text-primary-500 @endif whitespace-nowrap block w-full px-4 py-2  text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out">
                                <div class="flex justify-start gap-2">
                                    <div class="flex flex-col items-center justify-center">
                                        {{$lang['flag']}}
                                    </div>
                                    <div>
                                        {{$lang['label'][app()->getLocale()]}}
                                    </div>
                                </div>
                                </Link>
                            @endforeach
                        </x-tomato-admin-dropdown>
                    </div>
                </div>

                <div></div>
            </div>


            {{-- Dark Mode Button --}}
            <div>
                <div class="filament-notifications pointer-events-none fixed inset-4 z-50 mx-auto flex justify-end gap-3 items-end flex-col-reverse" role="status">
                </div>

                <!-- Notifications -->
                <div>
                    <!-- Open Notification Modal -->
                    <button
                        @click.prevent="data.dark = !data.dark; $splade.refresh()"
                        title="filament::layout.database_notifications"
                        type="button"
                        class="filament-icon-button flex items-center justify-center rounded-full relative hover:bg-gray-500/5 focus:outline-none text-primary-500 focus:bg-primary-500/10 dark:hover:bg-gray-300/5 w-10 h-10 ml-4 -mr-1">
                            <span class="sr-only">

                            </span>

                        <x-heroicon-o-sun v-if="data.dark" class="filament-icon-button-icon w-5 h-5"/>
                        <x-heroicon-o-moon v-else class="filament-icon-button-icon w-5 h-5"/>
                    </button>
                </div>

                <div></div>
            </div>


            @if(class_exists(\TomatoPHP\TomatoNotifications\Models\UserNotification::class))
            <!-- Notifications -->
            <div>
                <div class="filament-notifications pointer-events-none fixed inset-4 z-50 mx-auto flex justify-end gap-3 items-end flex-col-reverse" role="status">
                </div>

                <!-- Notifications -->
                <div>
                    <!-- Open Notification Modal -->
                    <Link modal href="{{route('admin.notifications.index')}}" class="inline-block">
                        <button
                            title="filament::layout.database_notifications"
                            type="button"
                            class="filament-icon-button flex items-center justify-center rounded-full relative hover:bg-gray-500/5 focus:outline-none text-primary-500 focus:bg-primary-500/10 dark:hover:bg-gray-300/5 w-10 h-10 ml-4 -mr-1">
                            <span class="sr-only">

                            </span>

                            <x-heroicon-o-bell class="filament-icon-button-icon w-5 h-5"/>

                            <span class="filament-icon-button-indicator absolute rounded-full text-xs inline-block w-4 h-4 -top-0.5 -right-0.5 bg-primary-500/10">
                                @php
                                    $notifications = \TomatoPHP\TomatoNotifications\Models\UserNotification::query()
                                            ->where('model_type', 'App\Models\User')
                                            ->where('model_id', auth('web')->user()->id)
                                            ->whereDoesntHave('userRead')
                                            ->get()
                                @endphp
                                {{
                                    $notifications->count()
                                }}
                            </span>
                        </button>
                    </Link>
                </div>

                <div></div>
            </div>
            @endif
            @foreach(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getNavBeforeUserDropdown() as $item)
                @include($item)
            @endforeach

            <x-tomato-admin-profile-dropdown />

            @foreach(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getNavAfterUserDropdown() as $item)
                @include($item)
            @endforeach
        </div>
    </div>
</header>
<x-splade-script>
    let docElm = document.getElementById("appBody");
    let button = document.querySelector('#fullScreen');
    button.addEventListener('click', function () {
        let isInFullScreen = (document.fullscreenElement && document.fullscreenElement !== null) ||
        (document.webkitFullscreenElement && document.webkitFullscreenElement !== null) ||
        (document.mozFullScreenElement && document.mozFullScreenElement !== null) ||
        (document.msFullscreenElement && document.msFullscreenElement !== null);
        if (!isInFullScreen) {
            button.classList.remove('bx-fullscreen');
            button.classList.add('bx-exit-fullscreen');
            if (docElm.requestFullscreen) {
                docElm.requestFullscreen();
            } else if (docElm.mozRequestFullScreen) {
                docElm.mozRequestFullScreen();
            } else if (docElm.webkitRequestFullScreen) {
                docElm.webkitRequestFullScreen();
            } else if (docElm.msRequestFullscreen) {
                docElm.msRequestFullscreen();
            }
        } else {
            if(document){
                button.classList.add('bx-fullscreen');
                button.classList.remove('bx-exit-fullscreen');
            if (document.exitFullscreen) {
            document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
            } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
            } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
            }
            }
        }

    });



</x-splade-script>
