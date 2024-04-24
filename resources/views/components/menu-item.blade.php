<li @mouseenter="$helpers.tooltip" class="filament-sidebar-item qts_tooltip_v1 sidebar_icon" data-tip="{{ $slot }}">
    @if(url()->current() == url($url))
        <x-splade-link
            href="{{url($url)}}"
            class="bg-primary-500 text-white flex items-center justify-center w-full gap-3 px-3 py-2 font-medium transition rounded-lg">

            <i class="w-5 h-5 shrink-0 {{$icon}}" style="font-size: 20px"></i>

            <div class="flex flex-1" v-show="!data.makeMenuMin" style="">
                <span>
                    {{ $slot }}
                </span>
                @if(isset($badge))
                    <span class="inline-flex items-center justify-center ml-auto rtl:ml-0 rtl:mr-auto min-h-4 px-2 py-0.5 text-xs font-medium tracking-tight rounded-xl whitespace-normal text-primary-700 bg-primary-500/10 dark:text-primary-500">
                        {{$badge}}
                    </span>
                @endif
            </div>
        </x-splade-link>
    @else
        <x-splade-link
            href="{{url($url)}}"
            class="hover:bg-zinc-500/5 focus:bg-zinc-500/5 dark:text-zinc-300 dark:hover:bg-zinc-700 flex items-center justify-center w-full gap-3 px-3 py-2 font-medium transition rounded-lg">

            <i class="w-5 h-5 shrink-0 {{$icon}}" style="font-size: 20px"></i>

            <div class="flex flex-1" v-show="!data.makeMenuMin" style="">
                <span>
                    {{ $slot }}
                </span>
                @if(isset($badge))
                    <span class="inline-flex items-center justify-center ml-auto rtl:ml-0 rtl:mr-auto min-h-4 px-2 py-0.5 text-xs font-medium tracking-tight rounded-xl whitespace-normal text-primary-700 bg-primary-500/10 dark:text-primary-500">
                        {{$badge}}
                    </span>
                @endif
            </div>
        </x-splade-link>
    @endif
</li>
