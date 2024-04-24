<x-splade-data
        default="{
        makeMenuHide: false,
        makeMenuMin:  false,
        dark: false,
        lang: {
            id: 'en',
            name: 'English'
        },
        asideMenuGroup: {},
        groupOpened: false
    }"

    remember="admin"
    local-storage
>

<div class="filament-body bg-zinc-50 text-zinc-950 dark:text-white dark:bg-black font-main" @load="data.dark" id="appBody">
    <div class="filament-app-layout flex w-full min-h-screen overflow-v-clip">

        <x-tomato-admin-aside />
        <div
                :class="{
                        'lg:pl-24 lg:pl-24 rtl:lg:pr-24 rtl:lg:pl-0': data.makeMenuMin,
                        'lg:pl-72 lg:pl-72 rtl:lg:pr-72 rtl:lg:pl-0': !data.makeMenuMin
                    }"
                class="
                        flex
                        filament-main
                        flex-col
                        gap-y-6
                        w-screen
                        min-h-screen
                        transition-all
                        filament-main-sidebar-open
                    "
        >

            <x-tomato-admin-navbar />

            <div class="filament-main-content flex-1 w-full px-4 mx-auto md:px-6 lg:px-8">
                @foreach(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getLayoutTop() as $item)
                    @include($item)
                @endforeach
                @isset($header)
                <header class="flex justify-between mb-4">
                    <div>
                        <div class="flex flex-col items-center justify-center">
                            <div class="flex justify-start gap-2">
                                <div>
                                    <i class="{{ $icon ?? 'bx bxs-category' }} text-1xl md:text-2xl font-bold text-primary-500"></i>
                                </div>
                                <h1 class="text-1xl md:text-2xl font-bold tracking-tight  filament-header-heading">
                                    {{ $header ?? '' }}
                                </h1>
                            </div>
                        </div>

                        @foreach(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getLayoutTitle() as $item)
                            @include($item)
                        @endforeach
                    </div>

                    <div class="flex jusitifiy-start gap-4">
                        {{ $buttons ?? '' }}

                        @if(count(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getLayoutButtons()))
                        <div>
                            @foreach(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getLayoutButtons() as $item)
                                @include($item)
                            @endforeach
                        </div>
                        @endif
                    </div>
                </header>
                @endif
                <!-- SLOT -->
                {{$slot}}

            </div>

            @foreach(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getLayoutBottom() as $item)
                @include($item)
            @endforeach

            <!-- Footer -->
            <x-tomato-admin-footer />
        </div>
    </div>
</div>
    <x-splade-script>
        if(localStorage.getItem("splade") && typeof document !== undefined){
                let spladeStorage = JSON.parse(localStorage.getItem("splade"));
        let dark = spladeStorage?.admin?.dark;
        document.body.classList[dark ? "add" : "remove"]("dark-scrollbars");
        document.documentElement.classList[dark ? "add" : "remove"]("dark");
        let htmlEl = document.querySelector("html");

        if ("{{app()->getLocale()}}" === "ar") {
        htmlEl.setAttribute("dir", "rtl");
        } else {
        htmlEl.setAttribute("dir", "ltr");
        }
        }

    </x-splade-script>
</x-splade-data>
