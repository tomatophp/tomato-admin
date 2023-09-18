<x-slot:body>
    <x-splade-data default="{tab: '{{array_keys($relations)[0]}}'}" :remember="array_keys($relations)[0]" local-storage>
        <div class="flex justify-center my-4">
            <nav
                class="filament-tabs flex overflow-x-auto items-center p-1 space-x-1 rtl:space-x-reverse text-sm text-gray-600 bg-gray-500/5 rounded-xl dark:bg-gray-500/20">

                @foreach($relations as $relation=>$label)
                    <x-splade-link :href="url()->current() . '?relation=' . $relation" @click.prevent="data.tab = '{{$relation}}'"
                            aria-selected="" role="tab" type="button"
                            v-bind:class="{'rounded-lg whitespace-nowrap shadow bg-white text-primary-600': data.tab ==='{{$relation}}'}"
                            class="flex whitespace-nowrap items-center h-8 px-5 font-medium hover:text-black-900  focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-inset   dark:text-white dark:bg-primary-600">
                        {{$label}}
                    </x-splade-link>
                @endforeach
            </nav>
        </div>
        <div class="bg-white p-6 rounded-xl border my-4">
            {{$slot}}
        </div>
    </x-splade-data>

</x-slot:body>


