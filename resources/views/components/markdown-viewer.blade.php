<x-splade-data
    default="{
        dark: false,
    }"

   remember="admin"
   local-storage
>
    <div class="font-main">
        <MdPreview v-if="data.dark" editorId="preview-only" modelValue="{{$content}}" language="en-US" {{ $attributes }} previewTheme="github" theme="dark" />
        <MdPreview v-else  editorId="preview-only" modelValue="{{$content}}" language="en-US" {{ $attributes }} previewTheme="github" />
    </div>
</x-splade-data>
