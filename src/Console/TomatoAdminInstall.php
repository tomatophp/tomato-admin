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
        $this->info('🍅 Publish Files ...');
        $this->handelFile('/tailwind.config.js', base_path('/tailwind.config.js'));
        $this->handelFile('/vite.config.js', base_path('/vite.config.js'));
        $this->handelFile('/package.json', base_path('/package.json'));
        $this->handelFile('/resources/js', resource_path('/js'), 'folder');
        $this->handelFile('/resources/css', resource_path('/css'), 'folder');
        $this->handelFile('/publish/markdown', resource_path('/markdown'), 'folder');
        $this->handelFile('/publish/emails', resource_path('/views/emails'), 'folder');
        $this->call('vendor:publish', [
            "--provider" => "Spatie\MediaLibrary\MediaLibraryServiceProvider",
            "--tag" => "medialibrary-migrations"
        ]);
        $this->callSilent('migrate');
        $this->callSilent('optimize:clear');
        $this->info('🍅 now please run yarn & yarn build');
        $this->info('🍅 Tomato Admin installed successfully.');
    }
}
