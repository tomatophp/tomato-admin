<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-white">
            {{ __('Team Name') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
            {{ __('The team\'s name and owner information.') }}
        </p>
    </header>

    <x-splade-form class="grid grid-cols-6 gap-6" :action="route('team-members.store', $team)">
        <div class="col-span-6">
            <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
                {{ __('Please provide the email address of the person you would like to add to this team.') }}
            </div>
        </div>

        <!-- Member Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-splade-input id="email" name="email" type="email" :label="__('Email')" />
        </div>

        <!-- Role -->
        @if(count($availableRoles) > 0)
            <div class="col-span-6 lg:col-span-4">
                <x-splade-group name="role" :label="__('Role')">
                    <div class="relative z-0 mt-1 border border-gray-200 rounded-lg cursor-pointer">
                        @foreach($availableRoles as $role)
                            <button
                                type="button"
                                class="relative px-4 py-3 inline-flex w-full rounded-lg focus:z-10 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200"
                                :class="{'border-t border-gray-200 rounded-t-none': @json(!$loop->first), 'rounded-b-none': @json(!$loop->last)}"
                                @click='form.role = @json($role->key)'
                            >
                                <div :class='{"opacity-50": form.role && form.role != @json($role->key)}'>
                                    <!-- Role Name -->
                                    <div class="flex items-center">
                                        <div class="text-sm text-gray-600" :class='{"font-semibold": form.role == @json($role->key)}'>
                                            {{ $role->name }}
                                        </div>

                                        <svg v-if='form.role == @json($role->key)' class="ml-2 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>

                                    <!-- Role Description -->
                                    <div class="mt-2 text-xs text-gray-600 text-left">
                                        {{ $role->description }}
                                    </div>
                                </div>
                            </button>
                        @endforeach
                    </div>
                </x-splade-group>
            </div>
        @endif

        <x-splade-submit :label="__('Save')" />

        <p class="text-sm text-gray-600 dark:text-gray-300" v-if="form.recentlySuccessful">{{ trans('tomato-admin::global.saved') }}</p>
    </x-splade-form>
</section>
