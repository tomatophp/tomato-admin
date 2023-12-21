<TomatoTooltip {{ $attributes }} :text="@js(trim($text))" :id="@js($id)" :position="@js($position)">
    {{$slot}}
</TomatoTooltip>
