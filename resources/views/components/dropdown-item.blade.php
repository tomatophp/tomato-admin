@if($type === 'button')
    <button {{ $attributes }} {{ $attributes->class([
            'text-gray-600 dark:text-gray-200 hover:text-black' => $black,
            'text-gray-600 dark:text-gray-200 hover:text-danger-500' => $danger,
            'text-gray-600 dark:text-gray-200 hover:text-warning-500' => $warning,
            'text-gray-600 dark:text-gray-200 hover:text-primary-500' => $primary,
            'text-gray-600 dark:text-gray-200 hover:text-success-500' => $success,
            'text-gray-600 dark:text-gray-200 hover:text-gray-500' => $secondary,
        ]) }} class="whitespace-nowrap py-2 flex items-center justify-between hover:bg-gray-100 dark:hover:bg-gray-900 px-4 w-full cursor-pointer transition-colors ease-in-out duration-200 ">
        <div  class="relative flex justify-center gap-2 ">
            <div class="flex flex-col items-center justify-center">
                <i class="{{$icon}} text-sm"></i>
            </div>
            <div class="text-sm ">
                {{$label}}
            </div>
        </div>
    </button>
@elseif($type === 'link')
        <x-splade-link {{ $attributes }} {{ $attributes->class([
            'text-gray-600 dark:text-gray-200 hover:text-black' => $black,
            'text-gray-600 dark:text-gray-200 hover:text-danger-500' => $danger,
            'text-gray-600 dark:text-gray-200 hover:text-warning-500' => $warning,
            'text-gray-600 dark:text-gray-200 hover:text-primary-500' => $primary,
            'text-gray-600 dark:text-gray-200 hover:text-success-500' => $success,
            'text-gray-600 dark:text-gray-200 hover:text-gray-500' => $secondary,
        ]) }} class="whitespace-nowrap py-2 flex items-center justify-between hover:bg-gray-100 dark:hover:bg-gray-900 px-4 w-full cursor-pointer transition-colors ease-in-out duration-200 ">
            <div class="relative flex justify-center gap-2">
                <div class="flex flex-col items-center justify-center">
                    <i class="{{$icon}} text-sm"></i>
                </div>
                <div class="text-sm ">
                    {{$label}}
                </div>
            </div>
        </x-splade-link>
@elseif($type === 'copy')
        <x-tomato-admin-copy {{ $attributes }} {{ $attributes->class([
            'text-gray-600 dark:text-gray-200 hover:text-black' => $black,
            'text-gray-600 dark:text-gray-200 hover:text-danger-500' => $danger,
            'text-gray-600 dark:text-gray-200 hover:text-warning-500' => $warning,
            'text-gray-600 dark:text-gray-200 hover:text-primary-500' => $primary,
            'text-gray-600 dark:text-gray-200 hover:text-success-500' => $success,
            'text-gray-600 dark:text-gray-200 hover:text-gray-500' => $secondary,
        ]) }} class="whitespace-nowrap py-2 flex items-center justify-between hover:bg-gray-100 dark:hover:bg-gray-900 px-4 w-full cursor-pointer transition-colors ease-in-out duration-200 ">
            <div class="relative flex justify-center gap-2">
                <div class="flex flex-col items-center justify-center">
                    <i class="{{$icon}} text-sm"></i>
                </div>
                <div class="text-sm ">
                    {{$label}}
                </div>
            </div>
        </x-tomato-admin-copy>
@endif
