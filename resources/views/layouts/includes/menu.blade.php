@foreach(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getSidebarTop() as $item)
    @include($item)
@endforeach
<div class="px-4 py-3 flex justify-start gap-4" v-show="!data.makeMenuMin">
    @php
        $email = auth('web')->user()->email;
        $size = 220;
        $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=identicon&s=" . $size;
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
</div>
<div v-show="!data.makeMenuMin" class="my-2 border-t border-gray-700"></div>
<div>
    <div class="text-sm">
        <div>
            <Link
                href="{{ route('admin') }}"
                class="
                @if(request()->routeIs('admin'))
                    bg-primary-500 text-white
                @else
                    text-gray-300 hover:bg-gray-500/5 focus:bg-gray-500/5 dark:text-gray-300 dark:hover:bg-gray-700
                @endif
                    flex items-center justify-center w-full py-3 font-medium transition" :class="{'gap-3 px-4': !data.makeMenuMin}">

                <i class="w-5 h-5 shrink-0 bx bxs-home" style="font-size: 20px"></i>

                <div class="flex flex-1" v-show="!data.makeMenuMin">
                    <span>
                        {{ trans("tomato-admin::global.dashboard") }}
                    </span>
                </div>
            </Link>
        </div>
    </div>
    <div v-show="data.makeMenuMin" class="my-2 border-t border-gray-700"></div>
</div>

@if(config('tomato-admin.menu_provider'))
    {!! config('tomato-admin.menu_provider')::render() !!}
@elseif(config('tomato-admin.menu_file'))
    @include(config('tomato-admin.menu_file'))
@else
    @php $counter = 0; @endphp
    @foreach($menus as $key=>$menu)
        <button @click.prevent="
        data.asideMenuGroup['{{str_replace(" ", "_", $key)}}'] =
        !data.asideMenuGroup['{{str_replace(" ", "_", $key)}}']"
                v-show="!data.makeMenuMin"
                class="w-full dark:text-gray-300 flex items-center justify-between gap-3 px-4 py-3 font-medium transition"
                :class="{
                    'bg-gray-900 hover:bg-gray-800 text-white': data.asideMenuGroup['{{str_replace(" ", "_", $key)}}'],
                    'text-gray-300 hover:bg-gray-500/5 dark:hover:bg-gray-700 focus:bg-gray-500/5': !data.asideMenuGroup['{{str_replace(" ", "_", $key)}}'],
                }">
            <div class="flex items-center gap-4">
                <p class="flex-1 text-xs font-bold tracking-wider uppercase">
                    {{ $key }}
                </p>
            </div>

            <svg v-if="data.asideMenuGroup" v-show="data.asideMenuGroup['{{str_replace(" ", "_", $key)}}']"
                 class="w-3 h-3 text-gray-600 transition-all dark:text-gray-300" xmlns="http://www.w3.org/2000/svg"
                 fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
            </svg>
            <svg v-if="data.asideMenuGroup" v-show="!data.asideMenuGroup['{{str_replace(" ", "_", $key)}}']"
                 class="w-3 h-3 text-gray-600 transition-all rotate-180 dark:text-gray-300"
                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                 aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <div>
            <div v-show="data.asideMenuGroup && data.asideMenuGroup['{{str_replace(' ', '_', $key)}}'] || data.makeMenuMin" class="text-sm" :class="{'bg-gray-950':!data.makeMenuMin}">
                @foreach($menu as $item)
                    <div class="filament-sidebar-item"  title="{{$item->label}}" style="color: {{$item->color}} !important;">
                        @if($item->target === '_blank')
                            <a
                                target="_blank"
                                href="{{$item->route ? route($item->route) : $item->url}}"
                                class="
                            @if($item->route && request()->routeIs($item->route))
                                bg-primary-500 text-white
                            @else
                                hover:bg-gray-500/5 focus:bg-gray-500/5 dark:text-gray-300 dark:hover:bg-gray-700
                            @endif
                          flex items-center justify-center w-full gap-3 px-4 py-2 font-medium transition rounded-lg">

                                <i class="w-5 h-5 shrink-0 {{ $item->icon }}" style="font-size: 20px"></i>

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
                                :class="{
                                    'ltr:pl-8 rtl:pr-8': !data.makeMenuMin
                                }"
                                class="
                            @if($item->route && request()->routeIs($item->route))
                                bg-primary-500 text-white
                            @else
                                text-gray-300 hover:bg-gray-500/5 focus:bg-gray-500/5 dark:text-gray-300 dark:hover:bg-gray-700
                            @endif
                           flex items-center justify-center w-full gap-3  py-3   pr-3 font-medium transition">

                            <i class="w-5 h-5 shrink-0 {{ $item->icon }}" style="font-size: 20px"></i>

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
    @endforeach
@endif

@foreach(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getSidebarBottom() as $item)
    @include($item)
@endforeach
