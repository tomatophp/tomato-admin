<TomatoSelect
    {{ $attributes->only(['v-if', 'v-show', 'class', '@select']) }}
    :multiple="@js($multiple)"
    :placeholder="@js($placeholder)"
    v-model="{{ $vueModel() }}"
    :dusk="@js($attributes->get('dusk'))"
    :remote-url="{!! $remoteUrl ?: 'null' !!}"
    :remote-root="@js($remoteRoot ?: null)"
    :option-value="@js($optionValue)"
    :option-label="@js($optionLabel)"
    :options="@js($options)"
    :getType="@js($type)"
    :paginated="@js($paginated)"
    :queryBy="@js($queryBy)"
    :loadMoreLabel="@js($loadMoreLabel)"
>
    <template #prepend>
        @includeWhen($label, 'splade::form.label', ['label' => $label])

        @if($prepend)
            <span :class="{ 'opacity-50': inputScope.disabled && @json(!$alwaysEnablePrepend) }" class="inline-flex items-center px-3 rounded-l-md border border-t-0 border-b-0 border-l-0 border-gray-200 bg-gray-50 dark:bg-gray-600 text-gray-50 dark:text-white">
                {!! $prepend !!}
            </span>
        @endif
    </template>
    <template #append>
        @if($append)
            <span :class="{ 'opacity-50': inputScope.disabled && @json(!$alwaysEnableAppend) }" class="inline-flex items-center px-3 rounded-r-md border border-t-0 border-b-0 border-r-0 border-gray-200 bg-gray-50 dark:bg-gray-600 text-gray-500 dark:text-white">
                {!! $append !!}
            </span>
        @endif

        @include('splade::form.help', ['help' => $help])
        @includeWhen($showErrors, 'splade::form.error', ['name' => $validationKey()])
    </template>
</TomatoSelect>
