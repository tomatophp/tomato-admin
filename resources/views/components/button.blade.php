@if($type === 'link')
<x-splade-link  {{ $attributes->class([
        'filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors',
        'focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4',
        'text-sm shadow-sm focus:ring-white filament-page-button-action',
        'bg-danger-600 hover:bg-danger-500 focus:bg-danger-700 focus:ring-offset-danger-700 text-white border-transparent' => $danger,
        'bg-warning-600 hover:bg-warning-500 focus:bg-warning-700 focus:ring-offset-warning-700 text-white border-transparent' => $warning,
        'bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 text-white border-transparent' => $primary,
        'bg-success-600 hover:bg-success-500 focus:bg-success-700 focus:ring-offset-success-700 text-white border-transparent' => $success,
        'bg-white hover:bg-gray-50 focus:bg-gray-100 focus:ring-offset-gray-95 text-gray-950 ring-gray-950/10' => $secondary,
    ]) }} :method="$method">
    {{$label ?: $slot}}
</x-splade-link>
@elseif($type === 'icon')
    <x-splade-link  {{ $attributes->class([
        'px-2',
        'text-danger-500' => $danger,
        'text-warning-500' => $warning,
        'text-primary-500' => $primary,
        'text-success-500' => $success
    ]) }} :method="$method">
        {{$label ?: $slot}}
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
        'bg-white hover:bg-gray-50 focus:bg-gray-100 focus:ring-offset-gray-95 text-gray-950 ring-gray-950/10' => $secondary,
    ]) }}>
        {{$label ?: $slot}}
    </button>
@endif
