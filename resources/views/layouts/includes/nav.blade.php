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

        <div class="flex items-center justify-between flex-1">

            <!-- breadcrumbs -->
            <div class="flex-1">
                @foreach(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getNavLeftSide() as $item)
                    @include($item)
                @endforeach
            </div>



            @if(class_exists(\TomatoPHP\TomatoNotifications\Models\UserNotification::class))
            <!-- Notifications -->
            <div>
                <div class="filament-notifications pointer-events-none fixed inset-4 z-50 mx-auto flex justify-end gap-3 items-end flex-col-reverse" role="status">
                </div>

                <!-- Notifications -->
                <div>
                    <!-- Open Notification Modal -->
                    <Link slideover href="/admin/notifications" class="inline-block">
                        <button
                            title="filament::layout.database_notifications"
                            type="button"
                            class="filament-icon-button flex items-center justify-center rounded-full relative hover:bg-gray-500/5 focus:outline-none text-primary-500 focus:bg-primary-500/10 dark:hover:bg-gray-300/5 w-10 h-10 ml-4 -mr-1">
                            <span class="sr-only">

                            </span>

                            <svg class="filament-icon-button-icon w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            <span class="filament-icon-button-indicator absolute rounded-full text-xs inline-block w-4 h-4 -top-0.5 -right-0.5 bg-primary-500/10">
                                {{
                                    \TomatoPHP\TomatoNotifications\Models\UserNotification::where('model_type',User::class)
                                            ->where('model_id', auth()->user()->id)
                                            ->orWhere('model_id', null)
                                            ->get()->count()
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
