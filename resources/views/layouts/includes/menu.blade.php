@foreach(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getSidebarTop() as $item)
    @include($item)
@endforeach

<div class="overflow-y-auto">
    <div>
        <div class="text-sm">
            <div>
                <Link
                    href="{{ route('admin') }}"
                    class="
                @if(request()->routeIs('admin'))
                    text-white font-bold
                @else
                    text-zinc-400 hover:bg-zinc-500/5 focus:bg-zinc-500/5 dark:text-zinc-300 dark:hover:bg-zinc-700
                @endif
                    flex items-center justify-center w-full py-3 font-medium transition" :class="{'gap-3 px-4': !data.makeMenuMin}">

                <div v-if="data.makeMenuMin">
                    <x-tomato-admin-tooltip :left="app()->getLocale() === 'ar'" :right="app()->getLocale() !== 'ar'" :text="trans('tomato-admin::global.dashboard')">
                        <i class="w-5 h-5 shrink-0 bx bxs-home" style="font-size: 20px"></i>
                    </x-tomato-admin-tooltip>
                </div>
                <div v-else>
                    <i class="w-5 h-5 shrink-0 bx bxs-home" style="font-size: 20px"></i>
                </div>


                <div class="flex-1 text-xs font-bold" v-show="!data.makeMenuMin">
                    <span>
                        {{ trans("tomato-admin::global.dashboard") }}
                    </span>
                </div>
                </Link>
            </div>
        </div>
        <div v-show="data.makeMenuMin" class="my-2 border-t border-zinc-700"></div>
    </div>
    <div>
        @if(config('tomato-admin.menu_provider'))
            {!! config('tomato-admin.menu_provider')::render() !!}
        @elseif(config('tomato-admin.menu_file'))
            @include(config('tomato-admin.menu_file'))
        @else
            @php $counter = 0; @endphp
            @foreach($menus as $key=>$menu)
                @if(isset($menu['menu']) ? count($menu['menu']) === 1 : count($menu) === 1)
                    @php $item = isset($menu['menu']) ? $menu['menu'][0] : $menu[0]; @endphp
                    <div class="filament-sidebar-item"  title="{{$item->label}}" style="color: {{$item->color}} !important;">
                        @if($item->target === '_blank')
                            <a
                                target="_blank"
                                href="{{$item->route ? route($item->route) : $item->url}}"
                                class="
                            @if($item->route && request()->routeIs($item->route))
                                text-white
                            @else
                                hover:bg-zinc-500/5 focus:bg-zinc-500/5 dark:text-zinc-300 dark:hover:bg-zinc-700
                            @endif
                          flex items-center justify-center w-full gap-3 px-4 py-2 font-medium transition rounded-lg">

                                <div v-if="data.makeMenuMin">
                                    <x-tomato-admin-tooltip :left="app()->getLocale() === 'ar'" :right="app()->getLocale() !== 'ar'" :text="$item->label">
                                        <i class="w-5 h-5 shrink-0 {{ $item->icon }}" style="font-size: 20px"></i>
                                    </x-tomato-admin-tooltip>
                                </div>
                                <div v-else>
                                    <i class="w-5 h-5 shrink-0 {{ $item->icon }}" style="font-size: 20px"></i>
                                </div>

                                <div class="flex flex-1" v-show="!data.makeMenuMin" style="">
                                <span>
                                    {{ $item->label }}
                                </span>
                                    @if($item->badge)
                                        <span
                                            class="inline-flex items-center justify-center ml-auto rtl:ml-0 rtl:mr-auto min-h-4 px-2 py-0.5 text-xs font-medium tracking-tight rounded-xl whitespace-normal text-primary-700 bg-primary-500/10 dark:text-primary-500">
                                    {{ $item->badge }}
                                </span>
                                    @endif
                                </div>
                            </a>
                        @else
                            <Link
                                href="{{$item->route ? route($item->route) : $item->url}}"
                                class="
                            @if($item->route && request()->routeIs($item->route))
                                text-white font-bold
                            @else
                                text-zinc-400 hover:bg-zinc-500/5 focus:bg-zinc-500/5 dark:text-zinc-300 dark:hover:bg-zinc-700
                            @endif
                           flex items-center justify-center w-full gap-3  py-3 font-medium transition" :class="{'gap-3 px-4': !data.makeMenuMin}">


                            <div v-if="data.makeMenuMin">
                                <x-tomato-admin-tooltip :left="app()->getLocale() === 'ar'" :right="app()->getLocale() !== 'ar'" :text="$item->label">
                                    <i class="w-5 h-5 shrink-0 {{ $item->icon }}" style="font-size: 20px"></i>
                                </x-tomato-admin-tooltip>
                            </div>
                            <div v-else class="flex flex-col justify-center items-center">
                                <i class="w-5 h-5 shrink-0 {{ $item->icon }}" style="font-size: 20px"></i>
                            </div>

                            <div class="flex-1 text-xs font-bold" v-show="!data.makeMenuMin" style="">
                                <span>
                                    {{ $item->label }}
                                </span>
                                @if($item->badge)
                                    <span
                                        class="inline-flex items-center justify-center ml-auto rtl:ml-0 rtl:mr-auto min-h-4 px-2 py-0.5 text-xs font-medium tracking-tight rounded-xl whitespace-normal text-primary-700 bg-primary-500/10 dark:text-primary-500">
                                    {{ $item->badge }}
                                </span>
                                @endif
                            </div>
                            </Link>
                        @endif
                    </div>
                    <div v-show="data.makeMenuMin" class="my-2 border-t border-zinc-700"></div>
                @else
                    <button @click.prevent="
            for(let i in data.asideMenuGroup){
                if(i !== '{{str_replace(" ", "_", isset($menu['key']) ?$menu['key'] : $key)}}'){
                    data.asideMenuGroup[i] = false;
                }
            };
            data.asideMenuGroup['{{str_replace(" ", "_", isset($menu['key']) ?$menu['key'] : $key)}}'] =
            !data.asideMenuGroup['{{str_replace(" ", "_", isset($menu['key']) ?$menu['key'] : $key)}}']"
                            v-show="!data.makeMenuMin"
                            class="w-full dark:text-zinc-300 flex items-center justify-between gap-3 px-4 py-3 font-medium transition"
                            :class="{
                        'bg-zinc-900 hover:bg-zinc-800 text-white': data.asideMenuGroup['{{str_replace(" ", "_", isset($menu['key']) ?$menu['key'] : $key)}}'],
                        'text-zinc-400 hover:bg-zinc-500/5 dark:hover:bg-zinc-700 focus:bg-zinc-500/5': !data.asideMenuGroup['{{str_replace(" ", "_", isset($menu['key']) ?$menu['key'] : $key)}}'],
                    }">
                        <div class="flex items-center gap-4">
                            <i class="w-5 h-5 shrink-0 bx @if(isset($menu['icon'])) {{$menu['icon']}} @else bxs-category @endif" style="font-size: 20px"></i>

                            <p class="flex-1 text-xs font-bold">
                                {{ isset($menu['label']) ? $menu['label'] : $key }}
                            </p>
                        </div>

                        <svg v-if="data.asideMenuGroup" v-show="data.asideMenuGroup['{{str_replace(" ", "_", isset($menu['key']) ?$menu['key'] : $key)}}']"
                             class="w-3 h-3 text-zinc-600 transition-all dark:text-zinc-300" xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                        </svg>
                        <svg v-if="data.asideMenuGroup" v-show="!data.asideMenuGroup['{{str_replace(" ", "_", isset($menu['key']) ?$menu['key'] : $key)}}']"
                             class="w-3 h-3 text-zinc-600 transition-all rotate-180 dark:text-zinc-300"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                             aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div>
                        <div
                            v-show="data.asideMenuGroup && data.asideMenuGroup['{{str_replace(' ', '_', isset($menu['key']) ?$menu['key'] : $key)}}'] || data.makeMenuMin" class="text-sm" :class="{'bg-zinc-950':!data.makeMenuMin}">
                            @foreach(isset($menu['menu']) ? $menu['menu'] : $menu as $item)
                                <div class="filament-sidebar-item"  title="{{$item->label}}" style="color: {{$item->color}} !important;">
                                    @if($item->target === '_blank')
                                        <a
                                            target="_blank"
                                            href="{{$item->route ? route($item->route) : $item->url}}"
                                            :class="{
                                    'ltr:pl-10 rtl:pr-10': !data.makeMenuMin
                                }"
                                            class="
                            @if($item->route && request()->routeIs($item->route))
                                text-white font-bold
                            @else
                                text-zinc-400 hover:bg-zinc-500/5 focus:bg-zinc-500/5 dark:text-zinc-300 dark:hover:bg-zinc-700
                            @endif
                           flex items-center justify-center w-full gap-3  py-3 font-medium transition">

                                            <div v-if="data.makeMenuMin">
                                                <x-tomato-admin-tooltip :left="app()->getLocale() === 'ar'" :right="app()->getLocale() !== 'ar'" :text="$item->label">
                                                    <i class="w-5 h-5 shrink-0 {{ $item->icon }}" style="font-size: 20px"></i>
                                                </x-tomato-admin-tooltip>
                                            </div>
                                            <div v-else class="flex flex-col justify-center items-center">
                                                <i class="w-5 h-5 shrink-0 {{ $item->icon }}" style="font-size: 20px"></i>
                                            </div>

                                            <div class="flex-1 text-xs font-bold" v-show="!data.makeMenuMin" style="">
                                <span>
                                    {{ $item->label }}
                                </span>
                                                @if($item->badge)
                                                    <span
                                                        class="inline-flex items-center justify-center ml-auto rtl:ml-0 rtl:mr-auto min-h-4 px-2 py-0.5 text-xs font-medium tracking-tight rounded-xl whitespace-normal text-primary-700 bg-primary-500/10 dark:text-primary-500">
                                    {{ $item->badge }}
                                </span>
                                                @endif
                                            </div>
                                        </a>
                                    @else
                                        <Link
                                            href="{{$item->route ? route($item->route) : $item->url}}"
                                            :class="{
                                    'ltr:pl-10 rtl:pr-10': !data.makeMenuMin
                                }"
                                            class="
                            @if($item->route && request()->routeIs($item->route))
                                text-white font-bold
                            @else
                                text-zinc-400 hover:bg-zinc-500/5 focus:bg-zinc-500/5 dark:text-zinc-300 dark:hover:bg-zinc-700
                            @endif
                           flex items-center justify-center w-full gap-3  py-2 font-medium transition">


                                        <div v-if="data.makeMenuMin">
                                            <x-tomato-admin-tooltip :left="app()->getLocale() === 'ar'" :right="app()->getLocale() !== 'ar'" :text="$item->label">
                                                <i class="w-5 h-5 shrink-0 {{ $item->icon }}" style="font-size: 20px"></i>
                                            </x-tomato-admin-tooltip>
                                        </div>
                                        <div v-else class="flex flex-col justify-center items-center">
                                            <i class="w-5 h-5 shrink-0 {{ $item->icon }}" style="font-size: 20px"></i>
                                        </div>

                                        <div class="flex-1 text-xs font-bold" v-show="!data.makeMenuMin" style="">
                                <span>
                                    {{ $item->label }}
                                </span>
                                            @if($item->badge)
                                                <span
                                                    class="inline-flex items-center justify-center ml-auto rtl:ml-0 rtl:mr-auto min-h-4 px-2 py-0.5 text-xs font-medium tracking-tight rounded-xl whitespace-normal text-primary-700 bg-primary-500/10 dark:text-primary-500">
                                    {{ $item->badge }}
                                </span>
                                            @endif
                                        </div>
                                        </Link>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @if($counter !== count($menus)-1)
                        <div v-show="data.makeMenuMin" class="my-2 border-t border-zinc-700"></div>
                    @endif
                    @php $counter++; @endphp
                @endif
            @endforeach
        @endif
    </div>
    <div class="flex flex-col justifiy-end">
        @foreach(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getSidebarBottom() as $item)
            @include($item)
        @endforeach
    </div>
</div>



