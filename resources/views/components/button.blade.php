@if($type === 'link')
<x-splade-link  {{ $attributes }} :class="
        '
            filament-button
            inline-flex
            items-center
            justify-center
            py-1
            gap-1
            font-medium
            rounded-lg
            border
            transition-colors
            focus:outline-none
            focus:ring-offset-2
            focus:ring-2
            focus:ring-inset
            dark:focus:ring-offset-0
            min-h-[2.25rem]
            px-4
            text-sm
            text-white
            shadow
            focus:ring-white
            border-transparent
            filament-page-button-action
        ' .
        ($danger ?
        'bg-danger-600
        hover:bg-danger-500
        focus:bg-danger-700
        focus:ring-offset-danger-700'
        : null)
        .
        ($warning ?
        '
        bg-warning-600
        hover:bg-warning-500
        focus:bg-warning-700
        focus:ring-offset-warning-700
        ' : null) .
        ($primary ?
        '
        bg-primary-600
        hover:bg-primary-500
        focus:bg-primary-700
        focus:ring-offset-primary-700
        ' : null) .
        ($success ?
        '
        bg-success-600
        hover:bg-success-500
        focus:bg-success-700
        focus:ring-offset-success-700
        ' : null) .
        (!$primary && !$success && !$warning && !$danger ?
            '
        bg-primary-600
        hover:bg-primary-500
        focus:bg-primary-700
        focus:ring-offset-primary-700
        ' : null
        )

    ">
    {{$label ?: $slot}}
</x-splade-link>
@elseif($type === 'icon')
    <x-splade-link  {{ $attributes }} :class="
        '
            px-2
        ' .
        ($danger ?
        'text-danger-500'
        : null)
        .
        ($warning ?
        '
        text-warning-500
        ' : null) .
        ($primary ?
        '
        text-primary-500
        ' : null) .
        ($success ?
        '
        text-success-500
        ' : null) .
        (!$primary && !$success && !$warning && !$danger ?
            '
            text-primary-500
        ' : null
        )

    ">
        {{$label ?: $slot}}
    </x-splade-link>
@else
    <button  class="filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action">
        {{$label ?: $slot}}
    </button>
@endif
