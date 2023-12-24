@if($type === 'button')
    <li class="whitespace-nowrap py-2 flex items-center justify-between">
        <button {{ $attributes }} {{ $attributes->class([
            'text-black hover:text-gray-700' => $black,
            'text-danger-500 hover:text-danger-400' => $danger,
            'text-warning-500 hover:text-warning-400' => $warning,
            'text-primary-500 hover:text-primary-400' => $primary,
            'text-success-500 hover:text-success-400' => $success,
            'text-gray-500 hover:text-gray-700' => $secondary,
        ]) }} class="relative flex justify-center gap-2 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-300 ">
            <div class="flex flex-col items-center justify-center">
                <i class="{{$icon}} text-sm"></i>
            </div>
            <div class="text-sm ">
                {{$label}}
            </div>
        </button>
    </li>
@elseif($type === 'link')
    <li class="whitespace-nowrap py-2 flex items-center justify-between">
        <x-splade-link {{ $attributes }} {{ $attributes->class([
            'text-black hover:text-gray-700' => $black,
            'text-danger-500 hover:text-danger-400' => $danger,
            'text-warning-500 hover:text-warning-400' => $warning,
            'text-primary-500 hover:text-primary-400' => $primary,
            'text-success-500 hover:text-success-400' => $success,
            'text-gray-500 hover:text-gray-700' => $secondary,
        ]) }} class="relative flex justify-center gap-2 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-300 ">
            <div class="flex flex-col items-center justify-center">
                <i class="{{$icon}} text-sm"></i>
            </div>
            <div class="text-sm ">
                {{$label}}
            </div>
        </x-splade-link>
    </li>
@elseif($type === 'copy')
    <li class="whitespace-nowrap py-2 flex items-center justify-between">
        <x-tomato-admin-copy {{ $attributes }} {{ $attributes->class([
            'text-black hover:text-gray-700' => $black,
            'text-danger-500 hover:text-danger-400' => $danger,
            'text-warning-500 hover:text-warning-400' => $warning,
            'text-primary-500 hover:text-primary-400' => $primary,
            'text-success-500 hover:text-success-400' => $success,
            'text-gray-500 hover:text-gray-700' => $secondary,
        ]) }} class="relative flex justify-center gap-2 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-300 ">
            <div class="flex flex-col items-center justify-center">
                <i class="{{$icon}} text-sm"></i>
            </div>
            <div class="text-sm ">
                {{$label}}
            </div>
        </x-tomato-admin-copy>
    </li>
@endif
