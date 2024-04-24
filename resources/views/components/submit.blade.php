@if($type === 'icon')
    <button  {{ $attributes->class([
          'px-2',
        'text-danger-500' => $danger,
        'text-warning-500' => $warning,
        'text-primary-500' => $primary,
        'text-success-500' => $success
]) }}>
        {{$label ?: $slot}}
    </button>
@else
    <button   {{$attributes->class([
         'filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors',
        'focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4',
        'text-sm shadow-sm focus:ring-white filament-page-button-action',
        'bg-danger-600 hover:bg-danger-500 focus:bg-danger-700 focus:ring-offset-danger-700 text-white border-transparent' => $danger,
        'bg-warning-600 hover:bg-warning-500 focus:bg-warning-700 focus:ring-offset-warning-700 text-white border-transparent' => $warning,
        'bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 text-white border-transparent' => $primary,
        'bg-success-600 hover:bg-success-500 focus:bg-success-700 focus:ring-offset-success-700 text-white border-transparent' => $success,
        'bg-white hover:bg-zinc-50 focus:bg-zinc-100 focus:ring-offset-zinc-95 text-zinc-950 ring-zinc-950/10' => $secondary,
])}}>
        @if(trim($slot))
            {{ $slot }}
        @else
            <div class="flex flex-row items-center justify-center">
                <svg
                        v-if="@js($spinner) && form.processing"
                        class="animate-spin mr-3 h-5 w-5 @if($secondary) text-zinc-700 @else text-white @endif" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                >
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                </svg>

                <span :class="{ 'opacity-50': form.processing || form.$uploading }">
                {{ $label }}
            </span>
            </div>
        @endif
    </button>
@endif
