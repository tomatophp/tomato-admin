<x-tomato-admin-layout>
    <div class="flex flex-col gap-4">
        @foreach(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getDashboardTop() as $item)
            @include($item)
        @endforeach
        <!-- Dashboard Widgets -->
        <div class="grid grid-cols-1 gap-4 filament-widgets-container md:grid-cols-2 lg:grid-cols-2">
            @php
                $hasWidgets = \TomatoPHP\TomatoAdmin\Services\TomatoWidget::get();
            @endphp
            @if(count($hasWidgets))
                @foreach($hasWidgets as $widget)
                    <x-tomato-admin-widget
                        :counter="$widget->counter"
                        :title="$widget->title"
                        :model="$widget->model"
                        :query="$widget->query"
                        :icon="$widget->icon"
                    />
                @endforeach
            @else
                @if(!count(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getDashboardTop()))
                    <div class="col-span-1 filament-widget filament-account-widget">
                    <div class="p-2 space-y-2 bg-white shadow rounded-xl dark:border-zinc-600 dark:bg-zinc-800">
                        <div class="space-y-2">
                            <div class="px-4 py-2 space-y-4">
                                <div class="flex items-center h-12 space-v-4 rtl:space-v-reverse">
                                    <div class="w-10 h-10 mx-4 bg-zinc-200 bg-center bg-cover rounded-full dark:bg-zinc-900"
                                         style="background-image: url('{{auth()->user()->profile_photo_url}}')">
                                    </div>

                                    <div>
                                        <h2 class="text-lg font-bold tracking-tight sm:text-xl">
                                            {{trans('tomato-admin::global.welcome')}}, {{auth()->user()->name}}
                                        </h2>

                                        <Link href="{{route('logout')}}" method="POST"
                                              class="text-zinc-600 hover:text-primary-500 focus:outline-none focus:underline dark:text-zinc-300 dark:hover:text-primary-500">
                                            {{trans('tomato-admin::global.logout')}}
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endif
        </div>

        @foreach(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getDashboardBottom() as $item)
            @include($item)
        @endforeach
    </div>
</x-tomato-admin-layout>
