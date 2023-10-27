<div class="flex justify-start">
    @if($view)
    <x-tomato-admin-button type="icon" success modal title="{{trans('tomato-admin::global.crud.view')}}" href="{{ route('admin.'.$table.'.show', $item->id) }}">
        <x-heroicon-s-eye class="h-6 w-6"/>
    </x-tomato-admin-button>
    @endif
    @if($edit)
    <x-tomato-admin-button type="icon" warning modal title="{{trans('tomato-admin::global.crud.edit')}}" href="{{ route('admin.'.$table.'.edit', $item->id) }}">
        <x-heroicon-s-pencil class="h-6 w-6"/>
    </x-tomato-admin-button>
    @endif
    @if($delete)
    <x-tomato-admin-button type="icon" title="{{trans('tomato-admin::global.crud.delete')}}" href="{{ route('admin.'.$table.'.destroy', $item->id) }}"
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
