<?php

namespace TomatoPHP\TomatoAdmin\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use TomatoPHP\ConsoleHelpers\Traits\HandleFiles;
use TomatoPHP\ConsoleHelpers\Traits\RunCommand;
use function Laravel\Prompts\confirm;

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
        $this->publish = base_path('vendor/tomatophp/tomato-admin/publish');
        parent::__construct();
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        \Laravel\Prompts\info('🍅 Please Note That The Following File Will Be Replaced By The New File');
        $update = confirm('Do You Want To Continue?', true, 'yes');
        if($update){

            \Laravel\Prompts\info('🍅 Updating Files ...');
            $this->handelFile('/tailwind.config.js', base_path('/tailwind.config.js'));
            $this->handelFile('/vite.config.js', base_path('/vite.config.js'));
            $this->handelFile('/package.json', base_path('/package.json'));
            $this->handelFile('/resources/js', resource_path('/js'), 'folder');
            $this->handelFile('/resources/css', resource_path('/css'), 'folder');
            $this->handelFile('/markdown', resource_path('/markdown'), 'folder');
            $this->handelFile('/emails', resource_path('/views/emails'), 'folder');
            $this->callSilent('optimize:clear');
            $this->callSilent('migrate');

            $checkConfigFile = base_path('vendor/tomatophp/tomato-admin/config/tomato-admin.php');
            if(File::exists($checkConfigFile)){
                File::delete(config_path('tomato-admin.php'));
                File::copy($checkConfigFile, config_path('tomato-admin.php'));
            }
            \Laravel\Prompts\info('run yarn & yarn build');
            \Laravel\Prompts\info('🍅 Upgrade Done!');

            $replaceUserModel = confirm('Do You Want To Publish User.php Model?', true, 'yes');
            if($replaceUserModel){
                $this->handelFile('/Models/User.php', app_path('/Models/User.php'));
                \Laravel\Prompts\info('🍅 User Model Published!');
            }

            \Laravel\Prompts\info('if yes please publish console-helper config and change yarn path you can find it by use command whereis yarn');
            $tryToInstallYarnPackages = confirm('Do You Want To try Install Yarn Packages?', true, 'yes');
            if($tryToInstallYarnPackages){
                $this->yarnCommand(['install']);
                $this->yarnCommand(['build']);
                \Laravel\Prompts\info('🍅 Yarn Packages Installed!');
            }
        }
        else {
            \Laravel\Prompts\error('Update Not Installed No file Changed!');
        }


        \Laravel\Prompts\info('🍅 Thanks for using Tomato Plugins & TomatoPHP framework');
        \Laravel\Prompts\info('💼 Join support server on discord https://discord.gg/VZc8nBJ3ZU');
        \Laravel\Prompts\info('📄 You can check docs here https://docs.tomatophp.com');
        \Laravel\Prompts\info('⭐ please gave us a start on any repo if you like it https://github.com/tomatophp');
        \Laravel\Prompts\info('🤝 sponser us here https://github.com/sponsors/3x1io');
    }
}
