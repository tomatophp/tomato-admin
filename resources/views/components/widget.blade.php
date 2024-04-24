<div  {{$attributes->class([
    "relative rounded-xl bg-white p-6 shadow-sm border border-zinc-100 dark:border-zinc-800 dark:bg-zinc-900 dark:ring-white/10"
])}} >
    <div class="flex justify-between gap-4">
        <div>
            <div class="flex items-center gap-x-2">
                <span class="text-sm font-medium text-zinc-500 dark:text-zinc-400"> {{$title}} </span>
            </div>
            <div class="text-3xl font-semibold tracking-tight text-zinc-950 dark:text-white">
                @if(\Illuminate\Support\Str::contains('${response.data}', $counter))
                    <div v-if="response.data">
                        @{{ response.data }}
                    </div>
                    <div v-else>
                        {{__('Empty Transactions')}}
                    </div>

                @else
                    {{$counter}}
                @endif
            </div>
        </div>
        @if($icon)
            @if($color)
                <div class="text-white text-center p-4 rounded-full" style="background-color: {{$color}}">
                    <div class="flex flex-col items-center justify-center">
                        <div class="{{$icon}} text-2xl"></div>
                    </div>
                </div>
            @else
                <div class="bg-primary-500 text-white text-center p-4 rounded-full">
                    <div class="flex flex-col items-center justify-center">
                        <div class="{{$icon}} text-2xl"></div>
                    </div>
                </div>
            @endif

        @endif
    </div>
</div>
