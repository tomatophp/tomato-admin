@foreach(\TomatoPHP\TomatoAdmin\Facade\TomatoSlot::getFooter() as $item)
    @include($item)
@endforeach
