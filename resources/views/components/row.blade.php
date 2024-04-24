<div @if(isset($table)) class="grid grid-cols-1 gap-2" @elseif($inline) class="flex justify-between border-b pb-3 mb-3" @endif>
    @if(!isset($table))
        @if($inline)
            <div class="flex items-center justify-between gap-x-3">
                <dt class="inline-flex items-center gap-x-3">
                <span class="text-sm font-medium leading-6 text-zinc-950 dark:text-white">
                    {{$label}}
                </span>
                </dt>
            </div>
        @else
            <div class="flex items-center justify-between gap-x-3">
                <dt class="inline-flex items-center gap-x-3">
                <span class="text-sm font-medium leading-6 text-zinc-950 dark:text-white">
                    {{$label}}
                </span>
                </dt>
            </div>
        @endif
    @endif
    <div class="grid gap-y-2">
        @if($type ==='bool' || !empty($value))
        @if($type === 'text' || $type === 'string' || $type === 'rich')
        <div class="flex fi-in-text">
            @if($href)
            <a class="min-w-0 flex-1" href="{{$href}}" target="_blank">
                <div class="inline-flex items-center gap-1.5 text-sm leading-6 text-zinc-950 dark:text-white underline" >
                    {!! $value !!}
                </div>
            </a>
            @else
                <div class="min-w-0 flex-1">
                    <div class="inline-flex items-center gap-1.5 text-sm leading-6 text-zinc-950 dark:text-white" >
                        {!! $value !!}
                    </div>
                </div>
            @endif
        </div>
        @elseif($type === 'password')
            <div class="flex justify-start gap-2">
                <div class="flex flex-col justify-center items-center">
                    <x-tomato-admin-copy :text="$value">
                        <x-tomato-admin-tooltip :text="__('Copy')">
                            <i class="bx bx-copy"></i>
                        </x-tomato-admin-tooltip>
                    </x-tomato-admin-copy>
                </div>
                <div>
                    *********
                </div>
            </div>
        @elseif($type === 'copy')
            <div class="flex justify-start gap-2">
                <div class="flex flex-col justify-center items-center">
                    <x-tomato-admin-copy :text="$value">

                    <x-tomato-admin-tooltip :text="__('Copy')">
                        <i class="bx bx-copy"></i>
                    </x-tomato-admin-tooltip>
                    </x-tomato-admin-copy>
                </div>
                <div>
                    {{ $value }}
                </div>
            </div>
        @elseif($type === 'badge')
            @if($href)
            <x-splade-link :href="$href" class="flex fi-in-text">
                <div class="min-w-0 flex-1">
                    <div
                        @if($color)
                            style="
                                color: {{$color}} !important;
                            "
                        @endif
                            class="bg-primary-100 whitespace-nowrap inline-flex items-center gap-2 justify-center ml-auto rtl:ml-0 rtl:mr-auto min-h-4 px-2 py-0.5 text-xs font-medium tracking-tight rounded-xl whitespace-normal text-primary-700 bg-primary-500/10 dark:text-primary-500" >
                        @if($icon)
                            <i class="{{$icon}}" ></i>
                        @endif
                        {!! $value !!}
                    </div>
                </div>
            </x-splade-link>
            @else
            <div class="flex fi-in-text">
                <div class="min-w-0 flex-1">
                    <div class="bg-primary-100 whitespace-nowrap inline-flex items-center justify-center ml-auto rtl:ml-0 rtl:mr-auto min-h-4 px-2 py-0.5 text-xs font-medium tracking-tight rounded-xl whitespace-normal text-primary-700 bg-primary-500/10 dark:text-primary-500" >
                        {!! $value !!}
                    </div>
                </div>
            </div>
            @endif
        @elseif($type === 'date')
                <div class="flex fi-in-text">
                    <div class="min-w-0 flex-10">
                        <div class="flex justifiy-start items-center gap-1.5 text-sm leading-6 text-zinc-950 dark:text-white  text-primary-600" >
                            <div class="flex flex-col item-center justifiy-center">
                                <i class="bx bx-calendar"></i>
                            </div>
                            <div>
                                {{$value}}
                            </div>
                        </div>
                    </div>
                </div>
        @elseif($type === 'datetime')
                <div class="flex fi-in-text">
                    <div class="min-w-0 flex-10">
                        <div class="flex justifiy-start items-center gap-1.5 text-sm leading-6 text-zinc-950 dark:text-white  text-primary-600" >
                            <div class="flex flex-col item-center justifiy-center">
                                <i class="bx bx-calender"></i>
                            </div>
                            <div>
                                {{$value}}
                            </div>
                        </div>
                    </div>
                </div>
        @elseif($type === 'time')
            <div class="flex fi-in-text">
                <div class="min-w-0 flex-10">
                    <div class="flex justifiy-start items-center gap-1.5 text-sm leading-6 text-zinc-950 dark:text-white  text-primary-600" >
                        <div class="flex flex-col item-center justifiy-center">
                            <i class="bx bx-time"></i>
                        </div>
                        <div>
                            {{$value}}
                        </div>
                    </div>
                </div>
            </div>
        @elseif($type === 'number')
            <div class="flex fi-in-text">
                <div class="min-w-0 flex-1">
                    <div class="inline-flex items-center gap-1.5 text-sm leading-6 text-zinc-950 dark:text-white" >
                       {{ number_format($value, 2) }}
                    </div>
                </div>
            </div>
        @elseif($type === 'color')
            <div class="flex fi-in-text">
                <div class="min-w-0 flex-1">
                    <div class="w-8 h-8 rounded-lg" style="background-color: {{$value}}"></div>
                </div>
            </div>
        @elseif($type === 'icon')
            <div class="flex fi-in-text">
                <div class="min-w-0 flex-1">
                    <div class="inline-flex items-center gap-1.5 leading-6 text-zinc-950 dark:text-white" >
                        <i class="{{$value}}"></i>
                    </div>
                </div>
            </div>
        @elseif($type === 'tel')
            <a href="tel:{{$value}}" target="_blank" class="flex fi-in-text">
                <div class="min-w-0 flex-10">
                    <div class="flex justifiy-start items-center gap-1.5 text-sm leading-6 text-zinc-950 dark:text-white  text-primary-600" >
                        <div class="flex flex-col item-center justifiy-center">
                            <i class="bx bx-phone"></i>
                        </div>
                        <div>
                            {{$value}}
                        </div>
                    </div>
                </div>
            </a>
        @elseif($type === 'email')
            <a href="mailto:{{$value}}" target="_blank" class="flex fi-in-text">
                <div class="min-w-0 flex-10">
                    <div class="flex justifiy-start items-center gap-1.5 text-sm leading-6 text-zinc-950 dark:text-white  text-primary-600" >
                        <div class="flex flex-col item-center justifiy-center">
                            <i class="bx bx-envelope"></i>
                        </div>
                        <div>
                            {{$value}}
                        </div>
                    </div>
                </div>
            </a>
        @elseif($type === 'bool')
            <div class="flex fi-in-text">
                <div class="min-w-0 flex-10">
                    <div class="flex justifiy-start items-center gap-1.5 text-sm leading-6 text-zinc-950 dark:text-white" >
                        @if($value === true)
                            <div class="w-4 h-4 bg-success-500 rounded-full">

                            </div>
                        @else
                            <div class="w-4 h-4 bg-zinc-500 rounded-full">

                            </div>
                        @endif

                    </div>
                </div>
            </div>
        @elseif($type === 'images')
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-2 mt-3">
            @foreach($value as $key=>$image)
                    <a href="{{$image->getUrl()}}" target="_blank">
                        @if(\Illuminate\Support\Str::contains($image->getUrl(), ['jpeg', 'jpg', 'png', 'gif', 'svg', 'webp', 'tif']))
                        <div class="bg-cover bg-center w-16 h-16 rounded-lg"  style="background-image:url('{{$image->getUrl()}}') ">
                        </div>
                            @elseif(!empty($image->getUrl()))
                                                    <span class="text-primary-500 font-bold">{{__('Download File')}}[{{$key}}]</span>

                        @else
                            -
                        @endif
                    </a>
            @endforeach
            </div>
        @elseif($type === 'image')
            <a href="{{$value}}" class="mt-3" target="_blank">
                @if(\Illuminate\Support\Str::contains( $value, ['jpeg', 'jpg', 'png', 'gif', 'svg', 'webp', 'tif']))
                <div class="bg-cover bg-center w-16 h-16 rounded-lg"  style="background-image:url('{{$value}}') ">
                </div>
                @elseif(!empty($value))
                    <span>{{__('Download File')}}</span>
                @else
                    -
                @endif
            </a>
        @else
            -
            @endif
        @else
            -
        @endif
    </div>
</div>
