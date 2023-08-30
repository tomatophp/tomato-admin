<div class="flex flex-col mb-4">
    <div class="flex items-center justify-between gap-x-3">
        <dt class="inline-flex items-center gap-x-3">
            <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                {{$label}}
            </span>
        </dt>
    </div>

    <div class="grid gap-y-2">
        @if($type === 'text')
        <div class="flex fi-in-text">
            <div class="min-w-0 flex-1">
                <div class="inline-flex items-center gap-1.5 text-sm leading-6 text-gray-950 dark:text-white" >
                    {{$value}}
                </div>
            </div>
        </div>
        @elseif($type === 'images' && is_array($value))
            <div class="grid grid-cols-2 gap-4">
            @foreach($value as $image)
                    <a href="{{$image->getUrl()}}" target="_blank">
                        <div class="bg-cover bg-center w-16 h-16 rounded-full"  style="background-image:url('{{$image->getUrl()}}') ">
                        </div>
                    </a>
            @endforeach
            </div>
        @elseif($type === 'image')
            <a href="{{$value}}" target="_blank">
                <div class="bg-cover bg-center w-16 h-16 rounded-full"  style="background-image:url('{{$value}}') ">
                </div>
            </a>
            @endif
    </div>
</div>
