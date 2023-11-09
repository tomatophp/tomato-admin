<TomatoClipboard :source="@js($text)" #default="{ copy, copied }">
    <button type="button" @click="copy" {{ $attributes }}>
        {{ $slot }}
    </button>
</TomatoClipboard>
