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
    }"

    remember="admin"
                local-storage
>

<div class="filament-body bg-gray-100 text-gray-900 dark:text-gray-100 dark:bg-gray-900 font-main" @load="data.dark">
    <div class="filament-app-layout flex w-full min-h-screen overflow-v-clip">
        <x-tomato-admin-aside />
        <div
                :class="{
                        'lg:pl-24 lg:pl-24 rtl:lg:pr-24 rtl:lg:pl-0': data.makeMenuMin,
                        'lg:pl-80 lg:pl-80 rtl:lg:pr-80 rtl:lg:pl-0': !data.makeMenuMin
                    }"
                class="
                        flex
                        filament-main
                        flex-col
                        gap-y-6
                        w-screen
                        flex-1
                        hidden
                        h-full
                        transition-all
                        filament-main-sidebar-open
                    "
                style="display: flex"
        >

            <x-tomato-admin-navbar />

            <div class="filament-main-content flex-1 w-full px-4 mx-auto md:px-6 lg:px-8 max-w-7xl">
                <header
                        class="mb-4 items-start justify-between space-y-2 filament-header sm:flex sm:space-y-0 sm:space-v-4 sm:rtl:space-v-reverse sm:py-4">
                    <h1 class="text-2xl font-bold tracking-tight md:text-3xl filament-header-heading">
                        {{ $header ?? '' }}
                    </h1>

                    <div>
                        {{ $buttons ?? '' }}
                    </div>
                </header>

                <!-- SLOT -->
                {{$slot}}
            </div>

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
