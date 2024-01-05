<!-- API Token Permissions Modal -->
<x-splade-modal :close-button="false" class="!p-0">
    <x-slot:title>
        {{ __('API Token Permissions') }}
    </x-slot:title>

    <x-splade-form class="flex flex-col gap-4" method="put" :action="route('api-tokens.update', $token['id'])" :default="['permissions' => $token['abilities']]">
        <x-splade-checkboxes
            name="permissions"
            class="grid grid-cols-1 md:grid-cols-2 gap-1"
            :options="array_combine($availablePermissions, $availablePermissions)"
        />

        <div class="flex justify-start gap-4">
            <x-tomato-admin-submit spianer :label="__('Save')" />
            <x-tomato-admin-button type="button" secondary :label="__('Cancel')" @click.prevent="modal.close" />
        </div>
    </x-splade-form>
</x-splade-modal>
