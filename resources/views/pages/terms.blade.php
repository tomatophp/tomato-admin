@seoTitle(__('Terms of Service'))

<div class="font-sans text-zinc-900 antialiased">
    <div class="pt-4 bg-zinc-100">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <div>
                <x-tomato-application-logo />
            </div>

            <x-splade-content class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose" :html="$terms" />

        </div>
    </div>
</div>
