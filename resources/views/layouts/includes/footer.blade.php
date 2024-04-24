<footer class="bg-white dark:bg-zinc-800 dark:border-zinc-700 p-4 border-t border-zinc-200 flex flex-col  items-center justify-center">
    @if(count(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getFooter()))

    @foreach(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getFooter() as $item)
        @include($item)
    @endforeach

    @else

    <div>
        <span class="text-sm">
            Made With <span>❤️</span> At
            <a href="https://docs.tomatophp.com" target="_blank" class="text-primary-500 hover:text-primary-600">TomatoPHP</a> &copy; {{ date('Y') }},
        </span>
        <span class="text-sm">
            Have a Bug? Please contact  <a href="https://discord.gg/VZc8nBJ3ZU" target="_blank" class="text-primary-500 hover:text-primary-600">Support</a>
        </span>
    </div>
    <div class="ml-4 text-center text-xs text-zinc-500 sm:text-right sm:ml-0">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </div>

    @endif
</footer>
