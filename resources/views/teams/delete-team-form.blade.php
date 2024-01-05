<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-white">
            {{ __('Delete Team') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
            {{ __('Permanently delete this team.') }}
        </p>
    </header>
    <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
        {{ __('Once a team is deleted, all of its resources and data will be permanently deleted. Before deleting this team, please download any data or information regarding this team that you wish to retain.') }}
    </div>

    <div class="mt-5">
        <x-splade-form
            method="delete"
            :action="route('admin.teams.destroy', $team)"
            :confirm="__('Delete Team')"
            :confirm-text="__('Are you sure you want to delete this team? Once a team is deleted, all of its resources and data will be permanently deleted.')"
            :confirm-button="__('Delete Team')"
        >
            <x-splade-submit :label="__('Delete Team')" />
        </x-splade-form>
    </div>

</section>
