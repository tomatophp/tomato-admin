<TomatoItems
    {{ $attributes->only(['v-if', 'v-show', 'class'])->class(['hidden' => $isHidden()]) }}
    @if($headers) :headers="@js($headers)" @else :headers="{!! $jsonHeaders !!}" @endif
     @if($requestData) :request="@js($requestData)" @else :request="{!! $requestJson !!}" @endif
     v-model="{{ $vueModel() }}"
     name="{{ $name }}"
     :placeholder="@js($placeholder)"
     :options="@js($options)"
     :location="@js(app()->getLocale() === 'ar' ? 'ar-EG' : 'en-US')"
     :currency="@js(setting('local_currency'))"
     data-validation-key="{{ $validationKey() }}">
    <template  #default="items">
        {{ $slot }}
    </template>
</TomatoItems>
