<x-splade-component is="dropdown"  v-bind:close-on-click="true">
    <x-slot:trigger>
        <div {{ $attributes }}>
            @isset($button)
                {{ $button }}
            @else
                @if($icon)
                    <i class="{{$icon}}"></i>
                @else
                    <div class="text-sm">
                        {{$label}}
                    </div>
                @endif
            @endif
        </div>
    </x-slot:trigger>
    <div class="w-60 mt-2 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 py-1 bg-white dark:bg-zinc-700">
        {{ $slot }}
    </div>
</x-splade-component>
