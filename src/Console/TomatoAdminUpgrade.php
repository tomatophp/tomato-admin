<?php

namespace TomatoPHP\TomatoAdmin\Console;

use Illuminate\Console\Command;
use TomatoPHP\ConsoleHelpers\Traits\HandleFiles;
use TomatoPHP\ConsoleHelpers\Traits\RunCommand;

class TomatoAdminUpgrade extends Command
{
    use RunCommand;
    use HandleFiles;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'tomato-admin:upgrade';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'upgrade tomato admin to next version can have some changes this command fix this';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->publish = base_path('vendor/tomatophp/tomato-admin/');
        parent::__construct();
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        $this->info('🍅 Updating Files ...');
        $this->handelFile('/publish/tailwind.config.js', base_path('/tailwind.config.js'));
        $this->handelFile('/publish/vite.config.js', base_path('/vite.config.js'));
        $this->handelFile('/publish/package.json', base_path('/package.json'));
        $this->handelFile('/config/tomato-admin.php', config_path('/tomato-admin.php'));
        $this->handelFile('/publish/resources/js', resource_path('/js'), 'folder');
        $this->handelFile('/publish/resources/css', resource_path('/css'), 'folder');
        $this->handelFile('/publish/markdown', resource_path('/markdown'), 'folder');
        $this->handelFile('/publish/emails', resource_path('/views/emails'), 'folder');
        $this->callSilent('optimize:clear');
        $this->info('run yarn & yarn build');
        $this->info('🍅 Upgrade Done!');
    }
}
