<div class="flex items-center justify-center min-h-screen py-12 text-gray-900 bg-gray-100 filament-login-page dark:bg-gray-900 dark:text-white">
    <div class="w-screen max-w-md px-6 -mt-16 space-y-8 md:mt-0 md:px-2">
        <div class="relative p-8 space-y-4 border border-gray-200 shadow-2xl bg-white/50 backdrop-blur-xl rounded-2xl dark:bg-gray-900/50 dark:border-gray-700">
            <div class="flex justify-center w-full">
                <x-tomato-application-logo class="block h-9 w-auto fill-current text-primary-500" />
            </div>

            <h2 class="text-2xl font-bold tracking-tight text-center">
                {{ $header ?? null }}
            </h2>

            <div>
               {{ $slot }}
            </div>
        </div>
    </div>
</div>
