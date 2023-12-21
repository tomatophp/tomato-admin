<footer class="bg-white dark:bg-gray-800 dark:border-gray-700 p-4 border-t border-gray-200 flex flex-col  items-center justify-center">
    @foreach(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getFooter() as $item)
        @include($item)
    @endforeach



    <div>
        <span class="text-sm">
            Made With <span>❤️</span> At
            <a href="https://docs.tomatophp.com" target="_blank" class="text-primary-500 hover:text-primary-600">TomatoPHP</a> &copy; {{ date('Y') }},
        </span>
        <span class="text-sm">
            Have a Bug? Please contact  <a href="https://discord.gg/VZc8nBJ3ZU" target="_blank" class="text-primary-500 hover:text-primary-600">Support</a>
        </span>
    </div>
    <div class="ml-4 text-center text-xs text-gray-500 sm:text-right sm:ml-0">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </div>
</footer>
