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
<div class="flex items-center justify-center min-h-screen py-12 text-zinc-900 bg-zinc-100 filament-login-page dark:bg-zinc-900 dark:text-white">
    <div class="w-screen max-w-md px-6 -mt-16 space-y-8 md:mt-0 md:px-2">
        <div class="relative p-8 space-y-4 border border-zinc-200 shadow-2xl bg-white/50 backdrop-blur-xl rounded-2xl dark:bg-zinc-900/50 dark:border-zinc-700">
            <div class="flex justify-center w-full">
                @if(count(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getLogoSection()))
                    @foreach(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getLogoSection() as $item)
                        @include($item)
                    @endforeach
                @else
                    <x-tomato-application-logo class="block h-9 w-auto fill-current text-primary-500" />
                @endif
            </div>

            <h2 class="text-2xl font-bold tracking-tight text-center">
                {{ $header ?? null }}
            </h2>

            <div>
               {{ $slot }}
            </div>
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
