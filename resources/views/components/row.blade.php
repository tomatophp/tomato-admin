<div class="flex flex-col">
    @if(!isset($table))
        <div class="flex items-center justify-between gap-x-3">
            <dt class="inline-flex items-center gap-x-3">
                <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                    {{$label}}
                </span>
            </dt>
        </div>
    @endif
    <div class="grid gap-y-2">
        @if($type ==='bool' || !empty($value))
        @if($type === 'text' || $type === 'string' || $type === 'rich')
        <div class="flex fi-in-text">
            <div class="min-w-0 flex-1">
                <div class="inline-flex items-center gap-1.5 text-sm leading-6 text-gray-950 dark:text-white" >
                    {!! $value !!}
                </div>
            </div>
        </div>
        @elseif($type === 'date')
                <div class="flex fi-in-text">
                    <div class="min-w-0 flex-10">
                        <div class="flex justifiy-start items-center gap-1.5 text-sm leading-6 text-gray-950 dark:text-white  text-primary-600" >
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
                        <div class="flex justifiy-start items-center gap-1.5 text-sm leading-6 text-gray-950 dark:text-white  text-primary-600" >
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
                    <div class="flex justifiy-start items-center gap-1.5 text-sm leading-6 text-gray-950 dark:text-white  text-primary-600" >
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
                    <div class="inline-flex items-center gap-1.5 text-sm leading-6 text-gray-950 dark:text-white" >
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
                    <div class="inline-flex items-center gap-1.5 leading-6 text-gray-950 dark:text-white" >
                        <i class="{{$value}}"></i>
                    </div>
                </div>
            </div>
        @elseif($type === 'tel')
            <a href="tel:{{$value}}" target="_blank" class="flex fi-in-text">
                <div class="min-w-0 flex-10">
                    <div class="flex justifiy-start items-center gap-1.5 text-sm leading-6 text-gray-950 dark:text-white  text-primary-600" >
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
                    <div class="flex justifiy-start items-center gap-1.5 text-sm leading-6 text-gray-950 dark:text-white  text-primary-600" >
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
                    <div class="flex justifiy-start items-center gap-1.5 text-sm leading-6 text-gray-950 dark:text-white" >
                        @if($value === true)
                            <x-heroicon-s-check-circle class="w-6 h-6 text-success-500" />
                        @else
                            <x-heroicon-s-x-circle class="w-6 h-6 text-danger-600"/>
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
