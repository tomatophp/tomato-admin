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
                    border-zinc-100
                    bg-white
                    dark:bg-zinc-800
                    dark:border-zinc-900
                ">
    <div class="flex items-center w-full px-2 sm:px-4 md:px-6 lg:px-8">
        <!-- hide button -->
        <button
                class="

                            shrink-0
                            flex
                            items-center
                            justify-center
                            w-10
                            h-10
                            transition
                            text-zinc-900
                            text-center
                            dark:text-zinc-100
                            rounded-full
                            focus:bg-primary-500/10
                            focus:outline-none
                            lg:z-10
                            lg:focus:bg-white
                            lg:focus:text-zinc-600
                            lg:-ml-[44px]
                            lg:w-6
                            lg:h-6
                            lg:text-zinc-500
                            lg:bg-white
                            lg:shadow
                            lg:dark:bg-zinc-900
                            lg:dark:focus:text-zinc-400
                            lg:mr-4
                            rtl:lg:ml-4
                            rtl:lg:-mr-[44px]
                        "

        >
            <div
                    @click.prevent="data.makeMenuMin = !data.makeMenuMin"
                    class="relative lg:absolute invisible lg:visible text-center flex justify-center"
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
                    class="relative lg:absolute visible lg:invisible flex justify-center text-center"
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
                        class="text-center border border-zinc-100 dark:border-zinc-700 filament-icon-button flex items-center justify-center rounded-full relative hover:bg-zinc-500/5 focus:outline-none text-primary-500 focus:bg-primary-500/10 dark:hover:bg-zinc-300/5 w-8 h-8 ml-4 -mr-1">
                            <span class="sr-only">

                            </span>

                        @php $langs = collect(config('tomato-admin.langs')) @endphp
                        <x-tomato-admin-dropdown>
                            <x-slot:button>
                                <div class="text-center flex flex-col item-center justify-center">
                                    {{ isset($langs->where('key', app()->getLocale())->first()['flag']) ? $langs->where('key', app()->getLocale())->first()['flag'] : __('Lang') }}
                                </div>
                            </x-slot:button>

                            @foreach($langs as $lang)
                                <Link href="{{route('admin.lang', ['lang' => $lang])}}" method="POST"  class="@if($lang['key'] === app()->getLocale())  text-primary-600 dark:text-primary-200 hover:text-zinc-500  @else text-zinc-600 dark:text-zinc-200 hover:text-primary-500 @endif whitespace-nowrap block w-full px-4 py-2  text-sm leading-5 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 focus:outline-none focus:bg-zinc-100 dark:focus:bg-zinc-800 transition duration-150 ease-in-out">
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
                        class="border border-zinc-100 dark:border-zinc-700 filament-icon-button flex items-center justify-center rounded-full relative hover:bg-zinc-500/5 focus:outline-none text-primary-500 focus:bg-primary-500/10 dark:hover:bg-zinc-300/5 w-8 h-8 ml-4 -mr-1">
                            <span class="sr-only">

                            </span>

                        <x-heroicon-o-sun v-if="data.dark" class="filament-icon-button-icon w-4 h-4"/>
                        <x-heroicon-o-moon v-else class="filament-icon-button-icon w-4 h-4"/>
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
                            class="border border-zinc-100 dark:border-zinc-700 filament-icon-button flex items-center justify-center rounded-full relative hover:bg-zinc-500/5 focus:outline-none text-primary-500 focus:bg-primary-500/10 dark:hover:bg-zinc-300/5 w-8 h-8 ml-4 -mr-1">
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
