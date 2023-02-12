<div
        v-cloak
        v-show="data.makeMenuHide"
        @click.prevent="$helpers.setStorage('makeMenuHide', 'toggle', true); data.makeMenuHide = !data.makeMenuHide"
        class="fixed inset-0 z-20 w-full h-full filament-sidebar-close-overlay bg-gray-900/50 lg:hidden"
>

</div>
<aside
        :class="{
            'hidden': !data.makeMenuHide,
            'w-24': data.makeMenuMin,
            'w-80': !data.makeMenuMin
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
                    bg-white
                    lg:border-r
                    rtl:lg:border-r-0
                    rtl:lg:border-l
                    lg:z-0
                    dark:bg-gray-800
                    dark:border-gray-700
                    filament-sidebar-open
                    translate-x-0
                    max-w-[20em]
                    lg:max-w-[var(--sidebar-width)]
                ">

    <header
            class="
                filament-sidebar-header
                border-b
                h-[4rem]
                shrink-0
                px-6 flex items-center dark:border-gray-700"
    >

        <Link
                href="{{route('admin')}}"
                class="block w-full font-bold"
                v-show="true"
                data-turbo="false"
                style=""
        >
            <x-application-logo class="block h-9 w-auto fill-current text-primary-500" />
        </Link>
    </header>

    <nav class="flex-1 py-6 overflow-y-auto filament-sidebar-nav">
        <div>
            @include('tomato-admin::layouts.includes.menu')
        </div>
    </nav>
</aside>
