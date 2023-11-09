<x-splade-toggle>
    <button  @click.prevent="toggle"  {{$attributes->class([
        "relative py-3 px-4 w-full hover:bg-gray-100 text-center"
    ])}}>
        <div class="flex justify-center gap-2 mt-1">
            <div>
                <i class="bx bx-chevron-down" v-show="!toggled"></i>
                <i class="bx bx-chevron-up" v-show="toggled"></i>
            </div>
            <div class="text-sm">
                {{$label}}
            </div>
        </div>
        <div v-show="toggled" class="absolute flex flex-col top-12 left-0 shadow-sm overflow-hidden w-full z-10 rounded-b-lg bg-white border border-gray-200">
            {{ $slot }}
        </div>
    </button>
</x-splade-toggle>
