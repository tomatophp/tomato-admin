<label>
    <span class="block mb-1 text-zinc-700 font-sans dark:text-white">{{$label ?? ''}}</span>
</label>
<MdEditor {{ $attributes->only(['v-if', 'v-show', 'class'])->class(['hidden' => $isHidden()]) }}
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
