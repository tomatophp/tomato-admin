<TomatoRepeater
    {{ $attributes->only(['v-if', 'v-show', 'class'])->class(['hidden' => $isHidden()]) }}
    :options="@js($options)"
    v-model="{{ $vueModel() }}"
>
    <template #default="repeater">
        <div class="block">
            <div class=" border border-zinc-300 p-4 rounded-lg">
                @if($prepend)
                    <span :class="{ 'opacity-50': inputScope.disabled && @json(!$alwaysEnablePrepend) }" class="inline-flex items-center px-3 rounded-l-md border border-t-0 border-b-0 border-l-0 border-zinc-300 bg-zinc-50 text-zinc-50 dark:text-white">
                    {!! $prepend !!}
                </span>
                @endif
                <div>
                    <div
                        class="mb-4 relative bg-white border border-zinc-300 shadow-sm rounded-xl dark:bg-zinc-800 dark:border-zinc-600"
                        v-for="(item, key) in repeater.main"
                        :key="key"
                    >
                        <header class="flex items-center h-10 overflow-hidden border-b bg-zinc-50 rounded-t-xl dark:bg-zinc-800 dark:border-zinc-700">
                            <p class="flex-none px-4 text-xs font-medium text-zinc-600 truncate dark:text-zinc-400">
                                @includeWhen($label, 'splade::form.label', ['label' => $label])
                            </p>
                            <div class="flex-1"></div>
                            @if($type !== 'schema' && !$disabled)
                                <ul class="flex divide-x rtl:divide-x-reverse dark:divide-zinc-700">
                                    <li>
                                        <button
                                            @click.prevent="repeater.removeItem(item)"
                                            class="flex items-center justify-center flex-none w-10 h-10 transition text-danger-600 hover:text-danger-500 dark:text-danger-500 dark:hover:text-danger-400"
                                        >
                                        <span class="sr-only">
                                            Delete
                                        </span>
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </li>
                                </ul>
                            @endif

                        </header>
                        <div class="px-6 py-4">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
                @if($type !== 'schema')
                    <div>
                        <div class="relative flex justify-center">
                            <button
                                @if($disabled)
                                    disabled
                                @endif
                                @click.prevent="repeater.addItem()"
                                class="disabled:bg-zinc-600 disabled:hover:bg-zinc-500  filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2rem] px-3 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700"
                            >
                                Add New {{$label}}
                            </button>
                        </div>
                    </div>
                @endif
                @if($append)
                    <span :class="{ 'opacity-50': inputScope.disabled && @json(!$alwaysEnableAppend) }" class="inline-flex items-center px-3 rounded-r-md border border-t-0 border-b-0 border-r-0 border-zinc-300 bg-zinc-50 text-zinc-500 dark:text-white">
                        {!! $append !!}
                    </span>
                @endif
            </div>
        </div>
        @include('splade::form.help', ['help' => $help])
        @includeWhen($showErrors, 'splade::form.error', ['name' => $validationKey()])
    </template>
</TomatoRepeater>
