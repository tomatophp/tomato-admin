<x-tomato-admin-layout>
    <x-slot:header>
        {{$label}}
    </x-slot:header>
    <x-slot:buttons>
        {{ $buttons ?? '' }}
    </x-slot:buttons>
    <div class="bg-white border-gray-200 dark:bg-gray-800 p-6 rounded-xl border dark:border-gray-700 mb-6">
        <x-splade-modal class="font-main">
            <x-slot:title>
                {{$label}}
            </x-slot:title>

            <div class="pt-3">
                {{$slot}}
            </div>
        </x-splade-modal>
    </div>

    @if(isset($body))
        {{$body}}
    @endif
</x-tomato-admin-layout>
