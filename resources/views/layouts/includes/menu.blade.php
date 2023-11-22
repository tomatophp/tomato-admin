@foreach(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getSidebarTop() as $item)
    @include($item)
@endforeach
<div>
    <ul class="mx-3 mt-2 space-y-1 text-sm">
        <li class="filament-sidebar-item ">
            <Link
                    href="{{ route('admin') }}"
                    class="
                @if(request()->routeIs('admin'))
                    bg-primary-500 text-white
                @else
                    hover:bg-gray-500/5 focus:bg-gray-500/5 dark:text-gray-300 dark:hover:bg-gray-700
                @endif
                flex items-center justify-center gap-3 px-3 py-2 font-medium transition rounded-lg">

                <i class="w-5 h-5 shrink-0 bx bxs-home" style="font-size: 20px"></i>

                <div class="flex flex-1" v-show="!data.makeMenuMin">
                    <span>
                        {{ trans("tomato-admin::global.dashboard") }}
                    </span>
                </div>
            </Link>
        </li>
    </ul>
</div>
<div class="my-3 ml-6 border-t rtl:ml-auto rtl:mr-6 dark:border-gray-700"></div>

@if(config('tomato-admin.menu_provider'))
    {!! config('tomato-admin.menu_provider')::render() !!}
@elseif(config('tomato-admin.menu_file'))
    @include(config('tomato-admin.menu_file'))
@else
    @php $counter = 0; @endphp
    <div class="mx-3 mt-2 space-y-1 text-sm">
    @foreach($menus as $key=>$menu)
        <x-tomato-admin-tooltip text="{{$key}}">
            <button v-if="!data.groupOpened" @click.prevent="
        data.asideMenuGroup['{{str_replace(" ", "_", $key)}}'] =
        !data.asideMenuGroup['{{str_replace(" ", "_", $key)}}']; data.groupOpened = !data.groupOpened"
                    class="hover:bg-gray-500/5 focus:bg-gray-500/5 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center justify-center w-full gap-3 px-3 py-2 font-medium transition rounded-lg">
                <i style="font-size: 20px" class="w-5 h-5 shrink-0 bx bx-chevron-right rlt:bx-chevron-left" v-if="data.asideMenuGroup" v-show="!data.asideMenuGroup['{{str_replace(" ", "_", $key)}}']"></i>

                <div class="flex flex-1" v-show="!data.makeMenuMin">
                    <span>{{ $key }}</span>
                </div>
            </button>
        </x-tomato-admin-tooltip>

        <div>
            <ul
                v-if="data.asideMenuGroup"
                v-show="data.asideMenuGroup['{{str_replace(" ", "_", $key)}}'] ">
                <li @click.prevent="data.groupOpened = !data.groupOpened; data.asideMenuGroup['{{str_replace(" ", "_", $key)}}'] = !data.asideMenuGroup['{{str_replace(" ", "_", $key)}}'];" class="filament-sidebar-item">
                    <x-tomato-admin-tooltip text="{{ $key }}">
                        <button
                            class="hover:bg-gray-500/5 focus:bg-gray-500/5 dark:text-gray-300 dark:hover:bg-gray-700 flex items-center justify-center w-full gap-3 px-3 py-2 font-medium transition rounded-lg">

                            <i  class="bx bx-chevron-left rlt:bx-chevron-right" style="font-size: 20px"></i>

                            <div class="flex flex-1" v-show="!data.makeMenuMin" style="">
                            <span>
                                {{ $key }}
                            </span>
                            </div>
                        </button>
                    </x-tomato-admin-tooltip>
                </li>
                @foreach($menu as $item)
                    <li class="filament-sidebar-item"  style="color: {{$item->color}} !important;">
                        <x-tomato-admin-tooltip text="{{$item->label}}">
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
                          flex items-center justify-center w-full gap-3 px-3 py-2 font-medium transition rounded-lg">

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
                                    class="
                            @if($item->route && request()->routeIs($item->route))
                                bg-primary-500 text-white
                            @else
                                hover:bg-gray-500/5 focus:bg-gray-500/5 dark:text-gray-300 dark:hover:bg-gray-700
                            @endif
                          flex items-center justify-center w-full gap-3 px-3 py-2 font-medium transition rounded-lg">

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
                        </x-tomato-admin-tooltip>
                    </li>
                @endforeach
            </ul>
        </div>
        @php $counter++; @endphp
    @endforeach
    </div>
@endif

@foreach(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getSidebarBottom() as $item)
    @include($item)
@endforeach
