<button @click.prevent="
        $helpers.setAsideMenuGroup('{{$key}}', true);
        data.asideMenuGroup['{{$key}}'] =
        !data.asideMenuGroup['{{$key}}']"
        v-show="!data.makeMenuMin"
        class="flex items-center justify-between w-full px-6" data-label="{{$label}}">
    <div class="flex items-center gap-4 text-zinc-600 dark:text-zinc-300">
        <p class="flex-1 text-xs font-bold tracking-wider uppercase">
            {{$label}}
        </p>
    </div>

    <svg v-if="data.asideMenuGroup" v-show="data.asideMenuGroup['{{$key}}']"
         class="w-3 h-3 text-zinc-600 transition-all dark:text-zinc-300" xmlns="http://www.w3.org/2000/svg"
         fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
    </svg>
    <svg v-if="data.asideMenuGroup" v-show="!data.asideMenuGroup['{{$key}}']"
         class="w-3 h-3 text-zinc-600 transition-all rotate-180 dark:text-zinc-300"
         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
         aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
    </svg>
</button>
<div>
    <ul class="mx-3 mt-2 space-y-1 text-sm transition-all overflow-hidden"
    :class="[(data.asideMenuGroup['{{$key}}'] || data.makeMenuMin)? 'max-h-screen':' max-h-0']"
        v-if="data.asideMenuGroup"
        {{-- v-show="data.asideMenuGroup['{{$key}}'] || data.makeMenuMin " --}}
        >
        {{$slot}}
    </ul>
</div>
