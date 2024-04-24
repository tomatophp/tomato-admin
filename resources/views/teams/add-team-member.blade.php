<section>
    <header>
        <h2 class="text-lg font-medium text-zinc-900 dark:text-white">
            {{ __('Add Team Member') }}
        </h2>

        <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-300">
            {{ __('Please provide the email address of the person you would like to add to this team.') }}
        </p>
    </header>

    <x-splade-form class="grid grid-cols-6 gap-6" :action="route('team-members.store', $team)">

        <!-- Member Email -->
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-splade-input id="email" name="email" type="email" :label="__('Email')" />
        </div>

        <!-- Role -->
        @if(count($availableRoles) > 0)
            <div class="col-span-6 lg:col-span-4">
                <x-splade-group name="role" :label="__('Role')">
                    <div class="relative z-0 mt-1 border border-zinc-200 dark:border-zinc-700 rounded-lg cursor-pointer">
                        @foreach($availableRoles as $role)
                            <button
                                type="button"
                                class="relative px-4 py-3 inline-flex w-full rounded-lg focus:z-10 focus:outline-none focus:border-blue-300 focus:ring-1 focus:ring-primary-500"
                                :class="{'border-t border-zinc-200 dark:border-zinc-700 rounded-t-none': @json(!$loop->first), 'rounded-b-none': @json(!$loop->last)}"
                                @click='form.role = @json($role->key)'
                            >
                                <div :class='{"opacity-50": form.role && form.role != @json($role->key)}'>
                                    <!-- Role Name -->
                                    <div class="flex items-center">
                                        <div class="text-sm dark:text-zinc-100 text-zinc-600" :class='{"font-semibold": form.role == @json($role->key)}'>
                                            {{ $role->name }}
                                        </div>

                                        <svg v-if='form.role == @json($role->key)' class="ml-2 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>

                                    <!-- Role Description -->
                                    <div class="mt-2 text-xs text-zinc-600 dark:text-zinc-200 text-left">
                                        {{ $role->description }}
                                    </div>
                                </div>
                            </button>
                        @endforeach
                    </div>
                </x-splade-group>
            </div>
        @endif


       <div class="col-span-6">
           <x-tomato-admin-submit spinner :label="__('Save')" />

           <p class="text-sm text-zinc-600 dark:text-zinc-300" v-if="form.recentlySuccessful">{{ trans('tomato-admin::global.saved') }}</p>
       </div>
    </x-splade-form>
</section>
