@if($type === 'button')
    <li class="whitespace-nowrap py-2 flex items-center justify-between hover:bg-gray-100 dark:hover:bg-gray-900 px-4">
        <button {{ $attributes }} {{ $attributes->class([
            'text-gray-600 dark:text-gray-200 hover:text-black' => $black,
            'text-gray-600 dark:text-gray-200 hover:text-danger-500' => $danger,
            'text-gray-600 dark:text-gray-200 hover:text-warning-500' => $warning,
            'text-gray-600 dark:text-gray-200 hover:text-primary-500' => $primary,
            'text-gray-600 dark:text-gray-200 hover:text-success-500' => $success,
            'text-gray-600 dark:text-gray-200 hover:text-gray-500' => $secondary,
        ]) }} class="relative flex justify-center gap-2 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 ">
            <div class="flex flex-col items-center justify-center">
                <i class="{{$icon}} text-sm"></i>
            </div>
            <div class="text-sm ">
                {{$label}}
            </div>
        </button>
    </li>
@elseif($type === 'link')
    <li class="whitespace-nowrap py-2 flex items-center justify-between hover:bg-gray-100 dark:hover:bg-gray-900 px-4">
        <x-splade-link {{ $attributes }} {{ $attributes->class([
            'text-gray-600 dark:text-gray-200 hover:text-black' => $black,
            'text-gray-600 dark:text-gray-200 hover:text-danger-500' => $danger,
            'text-gray-600 dark:text-gray-200 hover:text-warning-500' => $warning,
            'text-gray-600 dark:text-gray-200 hover:text-primary-500' => $primary,
            'text-gray-600 dark:text-gray-200 hover:text-success-500' => $success,
            'text-gray-600 dark:text-gray-200 hover:text-gray-500' => $secondary,
        ]) }} class="relative flex justify-center gap-2 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 ">
            <div class="flex flex-col items-center justify-center">
                <i class="{{$icon}} text-sm"></i>
            </div>
            <div class="text-sm ">
                {{$label}}
            </div>
        </x-splade-link>
    </li>
@elseif($type === 'copy')
    <li class="whitespace-nowrap py-2 flex items-center justify-between hover:bg-gray-100 dark:hover:bg-gray-900 px-4">
        <x-tomato-admin-copy {{ $attributes }} {{ $attributes->class([
            'text-gray-600 dark:text-gray-200 hover:text-black' => $black,
            'text-gray-600 dark:text-gray-200 hover:text-danger-500' => $danger,
            'text-gray-600 dark:text-gray-200 hover:text-warning-500' => $warning,
            'text-gray-600 dark:text-gray-200 hover:text-primary-500' => $primary,
            'text-gray-600 dark:text-gray-200 hover:text-success-500' => $success,
            'text-gray-600 dark:text-gray-200 hover:text-gray-500' => $secondary,
        ]) }} class="relative flex justify-center gap-2 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 ">
            <div class="flex flex-col items-center justify-center">
                <i class="{{$icon}} text-sm"></i>
            </div>
            <div class="text-sm ">
                {{$label}}
            </div>
        </x-tomato-admin-copy>
    </li>
@endif
