<TomatoTooltip {{ $attributes }} :text="@js(trim($text))" :id="@js($id)">
    {{$slot}}
</TomatoTooltip>
