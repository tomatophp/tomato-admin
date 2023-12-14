<TomatoSearch
    {{ $attributes
        ->mergeVueBinding(':remoteUrl', $remoteUrl)
        ->mergeVueBinding(':optionValue', $optionValue)
        ->mergeVueBinding(':remoteRoot', $remoteRoot)
    }}
        :optionLabel="@js($optionLabel)"
    @if($headers) :headers="@js($headers)" @else :headers="{!! $jsonHeaders !!}" @endif
    @if($requestData) :request="@js($requestData)" @else :request="{!! $requestJson !!}" @endif
    v-model="{{ $vueModel() }}"
    :placeholder="@js($placeholder)"
    name="{{ $name }}"
    data-validation-key="{{ $validationKey() }}"
>

</TomatoSearch>
