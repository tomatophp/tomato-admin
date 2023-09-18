<x-splade-table :for="$query" v-if="data.tab === '{{$name}}'">
    <x-splade-cell actions use="$slot, $show, $edit, $delete, $path">
        <div class="flex justify-start">
            {{  $slot }}
            @if($show)
                <x-tomato-admin-button modal success type="icon" :href="route('admin.'.$path.'.show', $item->id)" title="{{trans('tomato-admin::global.crud.view')}}">
                    <x-heroicon-s-eye class="h-6 w-6"/>
                </x-tomato-admin-button>
            @endif
            @if($edit)
                <x-tomato-admin-button warning modal type="icon" :href="route('admin.'.$path.'.edit', $item->id)" title="{{trans('tomato-admin::global.crud.edit')}}">
                    <x-heroicon-s-pencil class="h-6 w-6"/>
                </x-tomato-admin-button>
            @endif
            @if($delete)
                <x-tomato-admin-button type="icon"
                                       :href="route('admin.'.$path.'.destroy', $item->id)"
                                       title="{{trans('tomato-admin::global.crud.edit')}}"
                                       confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                       confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                       confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                       cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                       class="px-2 text-red-500"
                                       method="delete"
                >
                    <x-heroicon-s-trash class="h-6 w-6"/>
                </x-tomato-admin-button>
            @endif
        </div>
    </x-splade-cell>
</x-splade-table>

