<?php

namespace TomatoPHP\TomatoAdmin\Console;

use Illuminate\Console\Command;
use TomatoPHP\ConsoleHelpers\Traits\HandleFiles;
use TomatoPHP\ConsoleHelpers\Traits\RunCommand;

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
        $this->info('🍅 Install Splade / Breeze UI ...');
        $this->artisanCommand(["splade:install"]);
        $this->artisanCommand(["breeze:install"]);
        $this->info('🍅 Publish Files ...');
        $this->handelFile('/tailwind.config.js', base_path('/tailwind.config.js'));
        $this->handelFile('/vite.config.js', base_path('/vite.config.js'));
        $this->handelFile('/package.json', base_path('/package.json'));
        $this->handelFile('/config/tomato-php.php', config_path('/tomato-php.php'));
        $this->handelFile('/resources/js', resource_path('/js'), 'folder');
        $this->handelFile('/resources/css', resource_path('/css'), 'folder');
        $this->callSilent('optimize:clear');
        $this->info('🍅 Install NPM packages ...');
        $this->yarnCommand(['install']);
        $this->yarnCommand(['build']);
        $install = $this->ask('🍅 Do you want to install Tomato Plugins? (yes/no) [yes]:', 'yes');
        if($install === 'y' || $install === 'yes' || $install === null){
            $this->call('tomato:plugins');
        }
        else {
            $this->info('🍅 Tomato Admin installed successfully.');
        }
    }
}
