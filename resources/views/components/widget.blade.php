<div  {{$attributes->class([
    "fi-wi-stats-overview-stat relative rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-300 dark:bg-gray-900 dark:ring-white/10"
])}} >
    <div class="flex justify-start gap-4">
        @if($icon)
            <div class="flex flex-col items-center justify-center rtl:border-l ltr:border-r ltr:pr-4 rtl:pl-4 text-primary-500">
                <div class="text-custom-50 ">
                    <i class="{{$icon}} bx-lg"/>
                </div>
            </div>
        @endif
        <div class="grid gap-y-2">
            <div class="flex items-center gap-x-2">
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400"> {{$title}} </span>
            </div>
            <div class="text-3xl font-semibold tracking-tight text-gray-950 dark:text-white">
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
    </div>
</div>
