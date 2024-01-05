<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('Team Settings') }}
    </x-slot:header>

    <div class="pb-12">
        <div class="mx-auto  space-y-6">
            <div class="dark:bg-gray-800 dark:text-white p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl" dusk="update-profile-information">
                    @include('tomato-admin::teams.update-team-name-form')
                </div>
            </div>


            @if($permissions['canAddTeamMembers'])
                <div class="dark:bg-gray-800 dark:text-white p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl" dusk="add-team-member">
                        @include('tomato-admin::teams.add-team-member')
                    </div>
                </div>
            @endif

            @if($permissions['canAddTeamMembers'] && $team->teamInvitations->isNotEmpty())
                <div class="dark:bg-gray-800 dark:text-white p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl" dusk="team-member-invitations">
                        @include('tomato-admin::teams.team-member-invitations')
                    </div>
                </div>
            @endif

            @if($team->users->isNotEmpty())
                <div class="dark:bg-gray-800 dark:text-white p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl" dusk="manage-team-members">
                        @include('tomato-admin::teams.manage-team-members')
                    </div>
                </div>
            @endif

            @if($permissions['canDeleteTeam'] && !$team->personal_team)
                <div class="dark:bg-gray-800 dark:text-white p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl" dusk="delete-team-form">
                        @include('tomato-admin::teams.delete-team-form')
                    </div>
                </div>
            @endif
        </div>

    </div>
</x-tomato-admin-layout>
