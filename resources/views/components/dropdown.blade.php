<x-splade-toggle>
    <button  @click.prevent="toggle"  {{$attributes->class([
        "relative"
    ])}}>
        <div class="flex justify-center gap-2">
            @if($icon)
                <i class="{{$icon}}"></i>
            @else
                <div>
                    <i class="bx bx-chevron-down" v-show="!toggled"></i>
                    <i class="bx bx-chevron-up" v-show="toggled"></i>
                </div>
                <div class="text-sm">
                    {{$label}}
                </div>
            @endif
        </div>
        <div v-show="toggled" class="absolute flex flex-col top-12 left-0 shadow-sm overflow-hidden z-10 rounded-lg bg-white dark:bg-gray-800 dark:text-gray-200 dark:border-gray-700 border border-gray-200 w-80">
            {{ $slot }}
        </div>
    </button>
</x-splade-toggle>
