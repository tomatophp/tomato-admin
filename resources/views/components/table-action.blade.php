
@if($type === 'link')
        <x-splade-link  {{ $attributes->class([
        'text-left w-full px-4 py-2 text-sm  font-normal',
        'text-danger-700 dark:text-white dark:hover:bg-danger-600 hover:bg-zinc-50 hover:text-danger-900' => $danger,
        'text-warning-700 dark:text-white dark:hover:bg-warning-600 hover:bg-zinc-50 hover:text-warning-900' => $warning,
        'text-primary-700 dark:text-white dark:hover:bg-primary-600 hover:bg-zinc-50 hover:text-primary-900' => $primary,
        'text-success-700 dark:text-white dark:hover:bg-success-600 hover:bg-zinc-50 hover:text-success-900' => $success,
        'text-zinc-700 dark:text-white dark:hover:bg-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' => $secondary,
    ]) }} :method="$method">
        <div class="flex justify-start gap-2">
            @if($icon)
            <div class="flex flex-col justify-center items-center">
                <i class="{{$icon}}"></i>
            </div>
            @endif
            <div>
                {{$label ?: $slot}}
            </div>
        </div>
    </x-splade-link>
@else
    <button  {{ $attributes->class([
        'text-left w-full px-4 py-2 text-sm  font-normal',
        'text-danger-700 dark:text-white dark:hover:bg-danger-600 hover:bg-zinc-50 hover:text-danger-900' => $danger,
        'text-warning-700 dark:text-white dark:hover:bg-warning-600 hover:bg-zinc-50 hover:text-warning-900' => $warning,
        'text-primary-700 dark:text-white dark:hover:bg-primary-600 hover:bg-zinc-50 hover:text-primary-900' => $primary,
        'text-success-700 dark:text-white dark:hover:bg-success-600 hover:bg-zinc-50 hover:text-success-900' => $success,
        'text-zinc-700 dark:text-white dark:hover:bg-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' => $secondary,
    ]) }}>
        <div class="flex justify-start gap-2">
            @if($icon)
                <div class="flex flex-col justify-center items-center">
                    <i class="{{$icon}}"></i>
                </div>
            @endif
            <div>
                {{$label ?: $slot}}
            </div>
        </div>
    </button>
@endif
