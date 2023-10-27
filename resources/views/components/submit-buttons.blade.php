<div class="flex justify-start gap-2 pt-3">
    @if($save)
    <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
    @endif
    @if($edit)
    <x-tomato-admin-button warning :href="route('admin.'.$table.'.edit', $model->id)">
        {{__('Edit')}}
    </x-tomato-admin-button>
    @endif
    @if($delete)
    <x-tomato-admin-button
        danger
        :href="route('admin.'.$table.'.destroy', $model->id)"
        title="{{trans('tomato-admin::global.crud.edit')}}"
        confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
        confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
        confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
        cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
        class="px-2 text-red-500"
        method="delete"
    >
        {{__('Delete')}}
    </x-tomato-admin-button>
    @endif
    @if($cancel)
    <x-tomato-admin-button secondary :href="route('admin.'.$table.'.index')" label="{{__('Cancel')}}"/>
    @endif
</div>
