<TomatoDraggable
    {{ $attributes->only(['v-if', 'v-show', 'class'])->class(['hidden' => $isHidden()]) }}
    :options="@js($options)"
    :url="@js($url)"
    :orderBy="@js($orderBy)"
    :levels="@js($levels)"
>
    @if($prepend)
        <span :class="{ 'opacity-50': inputScope.disabled && @json(!$alwaysEnablePrepend) }" class="inline-flex items-center px-3 rounded-l-md border border-t-0 border-b-0 border-l-0 border-gray-300 bg-gray-50 text-gray-50 dark:text-white">
            {!! $prepend !!}
        </span>
    @endif

    <template #default="darg">
        {{ $slot }}
    </template>

    @if($append)
        <span :class="{ 'opacity-50': inputScope.disabled && @json(!$alwaysEnableAppend) }" class="inline-flex items-center px-3 rounded-r-md border border-t-0 border-b-0 border-r-0 border-gray-300 bg-gray-50 text-gray-500 dark:text-white">
            {!! $append !!}
        </span>
    @endif
</TomatoDraggable>
