<?php

namespace TomatoPHP\TomatoAdmin\Providers;

use TomatoPHP\TomatoAdmin\Actions\Jetstream\AddTeamMember;
use TomatoPHP\TomatoAdmin\Actions\Jetstream\CreateTeam;
use TomatoPHP\TomatoAdmin\Actions\Jetstream\DeleteTeam;
use TomatoPHP\TomatoAdmin\Actions\Jetstream\DeleteUser;
use TomatoPHP\TomatoAdmin\Actions\Jetstream\InviteTeamMember;
use TomatoPHP\TomatoAdmin\Actions\Jetstream\RemoveTeamMember;
use TomatoPHP\TomatoAdmin\Actions\Jetstream\UpdateTeamName;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

class JetstreamWithTeamsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configurePermissions();

        Jetstream::createTeamsUsing(CreateTeam::class);
        Jetstream::updateTeamNamesUsing(UpdateTeamName::class);
        Jetstream::addTeamMembersUsing(AddTeamMember::class);
        Jetstream::inviteTeamMembersUsing(InviteTeamMember::class);
        Jetstream::removeTeamMembersUsing(RemoveTeamMember::class);
        Jetstream::deleteTeamsUsing(DeleteTeam::class);
        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the roles and permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::role('admin', 'Administrator', [
            'create',
            'read',
            'update',
            'delete',
        ])->description('Administrator users can perform any action.');

        Jetstream::role('editor', 'Editor', [
            'read',
            'create',
            'update',
        ])->description('Editor users have the ability to read, create, and update.');
    }
}
