@foreach(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getSidebarTop() as $item)
    @include($item)
@endforeach
<!-- Search -->
<div class="my-4 px-6" v-show="!data.makeMenuMin">
    <div class="relative">
        <div class="filament-global-search-input">
            <label for="globalSearchInput" class="sr-only">
                {{trans('tomato-admin::global.search')}}
            </label>

            <div class="relative group max-w-md">
                <span class="absolute inset-y-0 left-0 flex items-center justify-center w-10 h-10 text-gray-500 pointer-events-none group-focus-within:text-primary-500 dark:text-gray-400">
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
                    <input  id="globalSearchInput" v-model="form.filter['global']" placeholder="{{trans('tomato-admin::global.search')}}" type="search" autocomplete="off" class="block w-full h-10 pl-10 bg-gray-400/10 text-gray-100 placeholder-gray-200 border-transparent transition duration-75 rounded-lg focus:bg-gray-800 focus:placeholder-gray-600 focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 dark:bg-gray-700 dark:text-gray-200 dark:placeholder-gray-600">
                </x-splade-form>
            </div>
        </div>
    </div>
</div>
<div v-show="!data.makeMenuMin" class="my-2 border-t border-gray-700"></div>
<x-splade-link href="{{route('admin.profile.edit')}}" class="px-4 py-3 flex justify-start gap-4" v-show="!data.makeMenuMin">
    @php
        $grav_url = auth()->user()->profile_photo_url;
    @endphp
    <div>
        <div class="w-14 h-14 rounded-full bg-gray-200 bg-cover bg-center dark:bg-gray-900" style="background-image: url('{{$grav_url}}')">
        </div>
    </div>
    <div class="flex flex-col items-center justify-center">
        <div>
            <h6 class="text-lg text-white font-bold">{{auth('web')->user()->name}}</h6>
            <p class="text-sm text-gray-300">{{auth('web')->user()->email}}</p>
        </div>
    </div>
</x-splade-link>
<div v-show="!data.makeMenuMin" class="my-2 border-t border-gray-700"></div>
<div>
    <div class="text-sm">
        <div>
            <Link
                href="{{ route('admin') }}"
                class="
                @if(request()->routeIs('admin'))
                    text-white font-bold
                @else
                    text-gray-400 hover:bg-gray-500/5 focus:bg-gray-500/5 dark:text-gray-300 dark:hover:bg-gray-700
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
    <div v-show="data.makeMenuMin" class="my-2 border-t border-gray-700"></div>
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
                                hover:bg-gray-500/5 focus:bg-gray-500/5 dark:text-gray-300 dark:hover:bg-gray-700
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
                                text-gray-400 hover:bg-gray-500/5 focus:bg-gray-500/5 dark:text-gray-300 dark:hover:bg-gray-700
                            @endif
                           flex items-center justify-center w-full gap-3  py-3 font-medium transition" :class="{'gap-3 px-4': !data.makeMenuMin}">


                        <div v-if="data.makeMenuMin">
                            <x-tomato-admin-tooltip :left="app()->getLocale() === 'ar'" :right="app()->getLocale() !== 'ar'" :text="$item->label">
                                <i class="w-5 h-5 shrink-0 {{ $item->icon }}" style="font-size: 20px"></i>
                            </x-tomato-admin-tooltip>
                        </div>
                        <div v-else>
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
                <div v-show="data.makeMenuMin" class="my-2 border-t border-gray-700"></div>
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
                        class="w-full dark:text-gray-300 flex items-center justify-between gap-3 px-4 py-3 font-medium transition"
                        :class="{
                        'bg-gray-900 hover:bg-gray-800 text-white': data.asideMenuGroup['{{str_replace(" ", "_", isset($menu['key']) ?$menu['key'] : $key)}}'],
                        'text-gray-400 hover:bg-gray-500/5 dark:hover:bg-gray-700 focus:bg-gray-500/5': !data.asideMenuGroup['{{str_replace(" ", "_", isset($menu['key']) ?$menu['key'] : $key)}}'],
                    }">
                    <div class="flex items-center gap-4">
                        <i class="w-5 h-5 shrink-0 bx @if(isset($menu['icon'])) {{$menu['icon']}} @else bxs-category @endif" style="font-size: 20px"></i>

                        <p class="flex-1 text-xs font-bold">
                            {{ isset($menu['label']) ? $menu['label'] : $key }}
                        </p>
                    </div>

                    <svg v-if="data.asideMenuGroup" v-show="data.asideMenuGroup['{{str_replace(" ", "_", isset($menu['key']) ?$menu['key'] : $key)}}']"
                         class="w-3 h-3 text-gray-600 transition-all dark:text-gray-300" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                    </svg>
                    <svg v-if="data.asideMenuGroup" v-show="!data.asideMenuGroup['{{str_replace(" ", "_", isset($menu['key']) ?$menu['key'] : $key)}}']"
                         class="w-3 h-3 text-gray-600 transition-all rotate-180 dark:text-gray-300"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                         aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div>
                    <div
                        v-show="data.asideMenuGroup && data.asideMenuGroup['{{str_replace(' ', '_', isset($menu['key']) ?$menu['key'] : $key)}}'] || data.makeMenuMin" class="text-sm" :class="{'bg-gray-950':!data.makeMenuMin}">
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
                                text-gray-400 hover:bg-gray-500/5 focus:bg-gray-500/5 dark:text-gray-300 dark:hover:bg-gray-700
                            @endif
                           flex items-center justify-center w-full gap-3  py-3 font-medium transition">

                                        <div v-if="data.makeMenuMin">
                                            <x-tomato-admin-tooltip :left="app()->getLocale() === 'ar'" :right="app()->getLocale() !== 'ar'" :text="$item->label">
                                                <i class="w-5 h-5 shrink-0 {{ $item->icon }}" style="font-size: 20px"></i>
                                            </x-tomato-admin-tooltip>
                                        </div>
                                        <div v-else>
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
                                text-gray-400 hover:bg-gray-500/5 focus:bg-gray-500/5 dark:text-gray-300 dark:hover:bg-gray-700
                            @endif
                           flex items-center justify-center w-full gap-3  py-2 font-medium transition">


                                    <div v-if="data.makeMenuMin">
                                        <x-tomato-admin-tooltip :left="app()->getLocale() === 'ar'" :right="app()->getLocale() !== 'ar'" :text="$item->label">
                                            <i class="w-5 h-5 shrink-0 {{ $item->icon }}" style="font-size: 20px"></i>
                                        </x-tomato-admin-tooltip>
                                    </div>
                                    <div v-else>
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
                    <div v-show="data.makeMenuMin" class="my-2 border-t border-gray-700"></div>
                @endif
                @php $counter++; @endphp
            @endif
        @endforeach
    @endif
</div>

<div class="flex flex-col justifiy-end">
    <div>
        <div class="my-2 border-t border-gray-700"></div>
        <div class="text-sm">
            <div>
                <Link
                    method="POST"
                    href="{{ route('logout') }}"
                    class="
                    text-danger-400 hover:bg-gray-500/5 focus:bg-gray-500/5
                    flex items-center justify-center w-full py-3 font-medium transition" :class="{'gap-3 px-4': !data.makeMenuMin}">


                <div v-if="data.makeMenuMin">
                    <x-tomato-admin-tooltip :left="app()->getLocale() === 'ar'" :right="app()->getLocale() !== 'ar'" :text="__('Logout')">
                        <i class="w-5 h-5 shrink-0 bx bx-log-out" style="font-size: 20px"></i>
                    </x-tomato-admin-tooltip>
                </div>
                <div v-else>
                    <i class="w-5 h-5 shrink-0 bx bx-log-out" style="font-size: 20px"></i>
                </div>

                <div class="flex flex-1" v-show="!data.makeMenuMin">
                    <span>
                        {{ __("Logout") }}
                    </span>
                </div>
                </Link>
            </div>
        </div>
    </div>
    @foreach(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getSidebarBottom() as $item)
        @include($item)
    @endforeach
</div>


