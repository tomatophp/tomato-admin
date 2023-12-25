<x-splade-component is="dropdown"  v-bind:close-on-click="true">
    <x-slot:trigger>
        <div {{ $attributes }}>
            @if($icon)
                <i class="{{$icon}}"></i>
            @else
                <div class="text-sm">
                    {{$label}}
                </div>
            @endif
        </div>
    </x-slot:trigger>
    <div class="mt-2 min-w-max rounded-lg border border-gray-200 dark:border-gray-700 dark:bg-gray-800 shadow-lg bg-white ring-1 ring-black ring-opacity-5 overflow-hidden">
        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
            {{ $slot }}
        </ul>
    </div>
</x-splade-component>
