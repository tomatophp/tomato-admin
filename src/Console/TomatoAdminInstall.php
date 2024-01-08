<?php

namespace TomatoPHP\TomatoAdmin\Console;

use Illuminate\Console\Command;
use TomatoPHP\ConsoleHelpers\Traits\HandleFiles;
use TomatoPHP\ConsoleHelpers\Traits\RunCommand;
use function Laravel\Prompts\confirm;

class TomatoAdminInstall extends Command
{
    use RunCommand;
    use HandleFiles;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'tomato-admin:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create a new CRUD for the application by tomato';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->publish = base_path('vendor/tomatophp/tomato-admin/publish');
        parent::__construct();
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        \Laravel\Prompts\info('🍅 Install Splade / Jetstream ...');
        $this->artisanCommand(["splade:install"]);
        \Laravel\Prompts\info('🍅 Publish Files ...');
        $this->handelFile('/Models/User.php', app_path('/Models/User.php'));
        $this->handelFile('/config/jetstream.php', base_path('/config/jetstream.php'));
        $this->handelFile('/config/fortify.php', base_path('/config/fortify.php'));
        $this->handelFile('/Models/User.php', app_path('/Models/User.php'));
        $this->handelFile('/app/Http/Middleware/RedirectIfAuthenticated.php', app_path('/Http/Middleware/RedirectIfAuthenticated.php'));
        $this->handelFile('/tailwind.config.js', base_path('/tailwind.config.js'));
        $this->handelFile('/vite.config.js', base_path('/vite.config.js'));
        $this->handelFile('/package.json', base_path('/package.json'));
        $this->handelFile('/resources/js', resource_path('/js'), 'folder');
        $this->handelFile('/resources/css', resource_path('/css'), 'folder');
        $this->handelFile('/resources/views/welcome.blade.php', resource_path('/views/welcome.blade.php'));
        $this->handelFile('/markdown', resource_path('/markdown'), 'folder');
        $this->handelFile('/emails', resource_path('/views/emails'), 'folder');
        $this->artisanCommand(['vendor:publish', '--provider="Spatie\MediaLibrary\MediaLibraryServiceProvider"', '--tag="medialibrary-migrations"']);
        $this->callSilent('migrate');
        $this->callSilent('optimize:clear');
        \Laravel\Prompts\info('🍅 now please run yarn & yarn build');
        \Laravel\Prompts\info('🍅 Tomato Admin installed successfully.');


        $tryToInstallYarnPackages = confirm('Do You Want To try Install Yarn Packages?', true, 'yes');
        if($tryToInstallYarnPackages){
            \Laravel\Prompts\warning('🍅 if yes please publish console-helper config and change yarn path you can find it by use command whereis yarn');
            $tryToInstallYarnPackagesGo = confirm('Do you want to proceed?', true, 'yes');
            if($tryToInstallYarnPackagesGo){
                $this->yarnCommand(['install']);
                $this->yarnCommand(['build']);
                \Laravel\Prompts\info('🍅 Yarn Packages Installed!');
            }
        }

        \Laravel\Prompts\info('🍅 Thanks for using Tomato Plugins & TomatoPHP framework');
        \Laravel\Prompts\info('💼 Join support server on discord https://discord.gg/VZc8nBJ3ZU');
        \Laravel\Prompts\info('📄 You can check docs here https://docs.tomatophp.com');
        \Laravel\Prompts\info('⭐ please gave us a start on any repo if you like it https://github.com/tomatophp');
        \Laravel\Prompts\info('🤝 sponser us here https://github.com/sponsors/3x1io');
    }
}
