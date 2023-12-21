@if($type === 'button')
    <button class="p-3 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-900" {{ $attributes }} {{ $attributes->class([
            'text-black' => $black,
            'text-danger-500' => $danger,
            'text-warning-500' => $warning,
            'text-primary-500' => $primary,
            'text-success-500' => $success
        ]) }}>
        <div class=" flex justify-start gap-4">
            <div class="flex flex-col justify-center items-center ">
                <i class="{{$icon}}"></i>
            </div>
            <div>
                <span class="text-sm">{{$label}}</span>
            </div>
        </div>
    </button>
@elseif($type === 'link')
    <x-splade-link class="p-3 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-900" {{ $attributes }} {{ $attributes->class([
            'text-black' => $black,
            'text-danger-500' => $danger,
            'text-warning-500' => $warning,
            'text-primary-500' => $primary,
            'text-success-500' => $success
        ]) }}>
        <div class=" flex justify-start gap-4">
            <div class="flex flex-col justify-center items-center ">
                <i class="{{$icon}}"></i>
            </div>
            <div>
                <span class="text-sm">{{$label}}</span>
            </div>
        </div>
    </x-splade-link>
@elseif($type === 'copy')
    <x-tomato-admin-copy class="p-3 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-900" {{ $attributes }} {{ $attributes->class([
            'text-black' => $black,
            'text-danger-500' => $danger,
            'text-warning-500' => $warning,
            'text-primary-500' => $primary,
            'text-success-500' => $success
        ]) }}>
        <div class=" flex justify-start gap-4">
            <div class="flex flex-col justify-center items-center ">
                <i class="{{$icon}}"></i>
            </div>
            <div>
                <span class="text-sm">{{$label}}</span>
            </div>
        </div>
    </x-tomato-admin-copy>
@endif
