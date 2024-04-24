<div class="flex justify-start ltr:ml-4 rtl:mr-0 mt-1">
    <div class="flex flex-col justify-center items-center">
        <x-tomato-admin-dropdown id="profile-dropdown">
            <x-slot:button>
                <div class="filament-dropdown-trigger cursor-pointer">
                    @php
                        $grav_url = auth()->user()->profile_photo_url;
                    @endphp
                        <!-- Profile -->
                    <div class="w-8 h-8 rounded-full bg-zinc-200 bg-cover bg-center dark:bg-zinc-900" style="background-image: url('{{$grav_url}}')">
                    </div>
                </div>
            </x-slot:button>

            <!-- Team Management -->
            <div class="block px-4 py-2 text-xs text-zinc-400">
                {{ __('Manage Account') }}
            </div>


            <x-tomato-admin-dropdown-item type="link" icon="bx bxs-user" :href="route('admin.profile.edit')" :label="auth()->user()->name"/>
            @if(\Laravel\Jetstream\Jetstream::hasApiFeatures())
                <x-tomato-admin-dropdown-item type="link" icon="bx bxs-lock" :href="route('admin.api-tokens.index')" :label="__('API Tokens')" />
            @endif
            <div class="border-t border-zinc-200 dark:border-zinc-600" />
            <x-tomato-admin-dropdown-item danger type="link" method="POST" icon="bx bx-log-out" :href="route('logout')"  :label="trans('tomato-admin::global.logout')"/>
        </x-tomato-admin-dropdown>
    </div>
</div>
