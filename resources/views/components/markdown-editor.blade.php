<x-splade-data
    default="{
        dark: false,
        lang: {
            id: 'en',
            name: 'English'
        },
    }"

    remember="admin"
    local-storage
>
<div v-if="data.dark">
    <label>
        <span class="block mb-1 text-zinc-700 font-sans dark:text-white">{{$label ?? ''}}</span>
    </label>
    <MdEditor theme="dark"  {{ $attributes->only(['v-if', 'v-show', 'class'])->class(['hidden' => $isHidden()]) }}
    v-model="{{ $vueModel() }}" :language="data.lang.id === 'ar' ? 'ar-EG' : 'en-US'" :preview="@js($preview)" :toolbars="[
              'bold',
              'underline',
              'italic',
              '-',
              'strikeThrough',
              'title',
              'sub',
              'sup',
              'quote',
              'unorderedList',
              'orderedList',
              'task',
              '-',
              'codeRow',
              'code',
              'link',
              'image',
              'table',
              'htmlPreview',
              'preview',
              'fullscreen',
              'prettier',
              'katex',
              'mermaid',

          ]">

    </MdEditor>
</div>
    <div v-else>
        <label>
            <span class="block mb-1 text-zinc-700 font-sans dark:text-white">{{$label ?? ''}}</span>
        </label>
        <MdEditor  previewTheme="github"  {{ $attributes->only(['v-if', 'v-show', 'class'])->class(['hidden' => $isHidden()]) }}
        v-model="{{ $vueModel() }}" language="en-US" :preview="@js($preview)" :toolbars="[
              'bold',
              'underline',
              'italic',
              '-',
              'strikeThrough',
              'title',
              'sub',
              'sup',
              'quote',
              'unorderedList',
              'orderedList',
              'task',
              '-',
              'codeRow',
              'code',
              'link',
              'image',
              'table',
          ]">

        </MdEditor>
    </div>
</x-splade-data>
