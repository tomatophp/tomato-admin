<?php

namespace TomatoPHP\TomatoAdmin\Console;

use App\Models\User;
use Illuminate\Console\Command;
use TomatoPHP\ConsoleHelpers\Traits\HandleFiles;
use TomatoPHP\ConsoleHelpers\Traits\RunCommand;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\password;
use function Laravel\Prompts\text;

class TomatoAdminUser extends Command
{
    use RunCommand;
    use HandleFiles;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'tomato:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create a new user for dashboard access';

    /**
     * @return void
     */
    public function handle(): void
    {
        $name = text('What is your name?', required: true);
        $email = text('What is your email?', required: true);
        $password = password('What is your password?', required: true);

        \Laravel\Prompts\info('Creating user...');

        User::query()->createOrFirst([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);


        \Laravel\Prompts\info('🍅 Thanks for using Tomato Plugins & TomatoPHP framework');
        \Laravel\Prompts\info('💼 Join support server on discord https://discord.gg/VZc8nBJ3ZU');
        \Laravel\Prompts\info('📄 You can check docs here https://docs.tomatophp.com');
        \Laravel\Prompts\info('⭐ please gave us a start on any repo if you like it https://github.com/tomatophp');
        \Laravel\Prompts\info('🤝 sponser us here https://github.com/sponsors/3x1io');
    }
}
