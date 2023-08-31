<div class="flex flex-col mb-4">
    <div class="flex items-center justify-between gap-x-3">
        <dt class="inline-flex items-center gap-x-3">
            <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                {{$label}}
            </span>
        </dt>
    </div>

    <div class="grid gap-y-2">
        @if($value)
        @if($type === 'text')
        <div class="flex fi-in-text">
            <div class="min-w-0 flex-1">
                <div class="inline-flex items-center gap-1.5 text-sm leading-6 text-gray-950 dark:text-white" >
                    {{$value}}
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
