@if($type === 'link' && !isset($icon))
    <x-splade-link  {{ $attributes->class([
            'filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border',
            'focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4',
            'text-sm shadow-sm focus:ring-white filament-page-button-action',
            'bg-danger-600 hover:bg-danger-500 focus:bg-danger-700 focus:ring-offset-danger-700 text-white border-transparent' => $danger,
            'bg-warning-600 hover:bg-warning-500 focus:bg-warning-700 focus:ring-offset-warning-700 text-white border-transparent' => $warning,
            'bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 text-white border-transparent' => $primary,
            'bg-success-600 hover:bg-success-500 focus:bg-success-700 focus:ring-offset-success-700 text-white border-transparent' => $success,
            'bg-white hover:bg-zinc-50 focus:bg-zinc-100 focus:ring-offset-zinc-95 text-zinc-950 ring-zinc-950/10  border border-zinc-200 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-200' => $secondary,
            'cursor-pointer transition-colors ease-in-out duration-20'
        ]) }} :method="$method">
        {{$label ?: $slot}}
    </x-splade-link>
@elseif($type === 'icon' || isset($icon))
    <x-splade-link  {{ $attributes->class([
            'px-2 cursor-pointer transition-colors ease-in-out duration-20',
            'text-danger-500  hover:text-danger-400' => $danger,
            'text-warning-500 hover:text-warning-400' => $warning,
            'text-primary-500 hover:text-primary-400' => $primary,
            'text-success-500 hover:text-success-400' => $success
        ]) }} title="{{$title}}" :method="$method">
        @if($title)
            <x-tomato-admin-tooltip :text="$title">
                @if(isset($icon))
                    <i class="{{$icon}} text-2xl"></i>
                @else
                    {{$slot}}
                @endif
            </x-tomato-admin-tooltip>
        @else
            {{$slot}}
        @endif
    </x-splade-link>
@else
    <button  {{ $attributes->class([
        'filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors',
        'focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4',
        'text-sm shadow-sm focus:ring-white filament-page-button-action',
        'bg-danger-600 hover:bg-danger-500 focus:bg-danger-700 focus:ring-offset-danger-700 text-white border-transparent' => $danger,
        'bg-warning-600 hover:bg-warning-500 focus:bg-warning-700 focus:ring-offset-warning-700 text-white border-transparent' => $warning,
        'bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 text-white border-transparent' => $primary,
        'bg-success-600 hover:bg-success-500 focus:bg-success-700 focus:ring-offset-success-700 text-white border-transparent' => $success,
        'bg-white hover:bg-zinc-50 focus:bg-zinc-100 focus:ring-offset-zinc-95 text-zinc-950 ring-zinc-950/10 border-transparent dark:bg-zinc-800 dark:text-zinc-200' => $secondary,
    ]) }}>
        {{$label ?: $slot}}
    </button>
@endif
