<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-zinc-900 dark:text-white">
            {{ trans('tomato-admin::global.profile.delete-title') }}
        </h2>

        <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-300">
            {{ trans('tomato-admin::global.profile.delete-description') }}
        </p>
    </header>

    <x-tomato-admin-button type="link" href="#confirm-user-deletion" dusk="open-delete-modal" class="inline-flex rounded-md shadow-sm bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline">
        {{  trans('tomato-admin::global.profile.delete-button') }}
    </x-tomato-admin-button>

    <x-splade-modal name="confirm-user-deletion">
        <x-splade-form dusk="confirm-user-deletion" method="delete" :action="route('admin.profile.destroy')">
            <h2 class="text-lg font-medium text-zinc-900 dark:text-white">
                {{ trans('tomato-admin::global.profile.delete-model-title') }}
            </h2>

            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-300">
                {{ trans('tomato-admin::global.profile.delete-model-description') }}
            </p>

            <div class="mt-6">
                <x-splade-input id="password" name="password" type="password"  :placeholder="trans('tomato-admin::global.profile.delete-model-password')" />
            </div>

            <div class="mt-6 flex gap-4 justify-end">
                <x-tomato-admin-button secondary type="button" @click.prevent="modal.close">
                    {{ trans('tomato-admin::global.cancel') }}
                </x-tomato-admin-button>

                <x-tomato-admin-submit danger spinner dusk="confirm-delete-account">
                    {{ trans('tomato-admin::global.profile.delete-model-button') }}
                </x-tomato-admin-submit>
            </div>
        </x-splade-form>
    </x-splade-modal>
</section>
