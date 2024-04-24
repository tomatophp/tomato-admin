@if($type === 'button')
    <button {{ $attributes->class([
            'text-zinc-600 dark:text-zinc-200 hover:text-black' => $black,
            'text-zinc-600 dark:text-zinc-200 hover:text-danger-500' => $danger,
            'text-zinc-600 dark:text-zinc-200 hover:text-warning-500' => $warning,
            'text-zinc-600 dark:text-zinc-200 hover:text-primary-500' => $primary,
            'text-zinc-600 dark:text-zinc-200 hover:text-success-500' => $success,
            'text-zinc-600 dark:text-zinc-200 hover:text-zinc-500' => $secondary,
            'whitespace-nowrap block w-full px-4 py-2  text-sm leading-5 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 focus:outline-none focus:bg-zinc-100 dark:focus:bg-zinc-800 transition duration-150 ease-in-out'
        ]) }}>
        <div class="flex justify-start gap-2 ">
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
            'text-zinc-600 dark:text-zinc-200 hover:text-black' => $black,
            'text-zinc-600 dark:text-zinc-200 hover:text-danger-500' => $danger,
            'text-zinc-600 dark:text-zinc-200 hover:text-warning-500' => $warning,
            'text-zinc-600 dark:text-zinc-200 hover:text-primary-500' => $primary,
            'text-zinc-600 dark:text-zinc-200 hover:text-success-500' => $success,
            'text-zinc-600 dark:text-zinc-200 hover:text-zinc-500' => $secondary,
        ]) }} class="whitespace-nowrap block w-full px-4 py-2  text-sm leading-5 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 focus:outline-none focus:bg-zinc-100 dark:focus:bg-zinc-800 transition duration-150 ease-in-out">
            <div class="flex justify-start gap-2">
                <div class="flex flex-col items-center justify-center">
                    <i class="{{$icon}} text-sm"></i>
                </div>
                <div>
                    {{$label}}
                </div>
            </div>
        </x-splade-link>
@elseif($type === 'copy')
        <x-tomato-admin-copy {{ $attributes }} {{ $attributes->class([
            'text-zinc-600 dark:text-zinc-200 hover:text-black' => $black,
            'text-zinc-600 dark:text-zinc-200 hover:text-danger-500' => $danger,
            'text-zinc-600 dark:text-zinc-200 hover:text-warning-500' => $warning,
            'text-zinc-600 dark:text-zinc-200 hover:text-primary-500' => $primary,
            'text-zinc-600 dark:text-zinc-200 hover:text-success-500' => $success,
            'text-zinc-600 dark:text-zinc-200 hover:text-zinc-500' => $secondary,
        ]) }} class="whitespace-nowrap block w-full px-4 py-2  text-sm leading-5 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 focus:outline-none focus:bg-zinc-100 dark:focus:bg-zinc-800 transition duration-150 ease-in-out">
            <div class="flex justify-start gap-2">
                <div class="flex flex-col items-center justify-center">
                    <i class="{{$icon}} text-sm"></i>
                </div>
                <div>
                    {{$label}}
                </div>
            </div>
        </x-tomato-admin-copy>
@endif
