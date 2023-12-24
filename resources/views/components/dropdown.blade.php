<x-splade-component is="button-with-dropdown"  v-bind:close-on-click="true">
    <x-slot:button>
        <div {{ $attributes }}>
            @if($icon)
                <i class="{{$icon}}"></i>
            @else
                <div class="text-sm">
                    {{$label}}
                </div>
            @endif
        </div>
    </x-slot:button>
    <div class="px-4">
        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
            {{ $slot }}
        </ul>
    </div>
</x-splade-component>
