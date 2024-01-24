<div class="flex justify-start gap-4 ml-4 rtl:mr-4">
    <div class="flex flex-col justify-center items-center">
        <x-tomato-admin-dropdown id="profile-dropdown">
            <x-slot:button>
                <div class="filament-dropdown-trigger cursor-pointer">
                    @php
                        $grav_url = auth()->user()->profile_photo_url;
                    @endphp
                        <!-- Profile -->
                    <div class="w-10 h-10 rounded-full bg-gray-200 bg-cover bg-center dark:bg-gray-900" style="background-image: url('{{$grav_url}}')">
                    </div>
                </div>
            </x-slot:button>

            <!-- Team Management -->
            <div class="block px-4 py-2 text-xs text-gray-400">
                {{ __('Manage Account') }}
            </div>


            <x-tomato-admin-dropdown-item type="link" icon="bx bxs-user" :href="route('admin.profile.edit')" :label="auth()->user()->name"/>
            @if(\Laravel\Jetstream\Jetstream::hasApiFeatures())
                <x-tomato-admin-dropdown-item type="link" icon="bx bxs-lock" :href="route('admin.api-tokens.index')" :label="__('API Tokens')" />
            @endif
            <div class="border-t border-gray-200 dark:border-gray-600" />
            <x-tomato-admin-dropdown-item danger type="link" method="POST" icon="bx bx-log-out" :href="route('logout')"  :label="trans('tomato-admin::global.logout')"/>
        </x-tomato-admin-dropdown>
    </div>
</div>
