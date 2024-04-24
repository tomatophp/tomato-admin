<section>
    <header>
        <h2 class="text-lg font-medium text-zinc-900 dark:text-white">
            {{ __('Pending Team Invitations') }}
        </h2>

        <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-300">
            {{ __('These people have been invited to your team and have been sent an invitation email. They may join the team by accepting the email invitation.') }}
        </p>
    </header>

    <div class="grid grid-cols-6 gap-6">
        <div class="my-4">
            @foreach($team->teamInvitations as $invitation)
                <div class="flex items-center justify-between">
                    <div class="text-zinc-600 dark:text-zinc-400">
                        {{ $invitation->email }}
                    </div>

                    @if($permissions['canRemoveTeamMembers'])
                        <div class="flex items-center">
                            <!-- Cancel Team Invitation -->
                            <x-splade-form
                                method="delete"
                                :action="route('team-invitations.destroy', $invitation)"
                            >
                                <button type="submit" class="cursor-pointer ltr:ml-6 rtl:mr-6 text-sm text-red-500 focus:outline-none">
                                    {{ __('Cancel') }}
                                </button>
                            </x-splade-form>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

</section>
