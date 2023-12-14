<?php

namespace TomatoPHP\TomatoAdmin\View\Components;

use Illuminate\Support\Js;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\View\View;
use ProtoneMedia\Splade\Components\Form;
use ProtoneMedia\Splade\Components\Form\InteractsWithFormElement;
use ProtoneMedia\Splade\Components\ParsesJsonDataAttribute;

class Items extends Component
{
    use InteractsWithFormElement;
    use ParsesJsonDataAttribute;

    public $requestData;

    public $requestJson;

    public $headers;

    public $jsonHeaders;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name = '',
        public string $vModel = '',
        public string $type = 'text',
        public string $method = 'POST',
        public string $label = '',
        public array $options = [],
        public string $validationKey = '',
        public bool $showErrors = true,
        public string $prepend = '',
        public string $append = '',
        public string $help = '',
        public bool $alwaysEnablePrepend = false,
        public bool $alwaysEnableAppend = false,
        public string $remoteUrl = '',
        public string $remoteRoot = '',
        public string $optionValue = 'object',
        public string $optionLabel = 'name',
        public string $placeholder = '',
        public string $itemPlaceholder = '',
        public bool $disabled = false,
          $request = null,
          $headers = null
    )
    {
        Form::allowAttribute($name);

        $parsed = $this->parseJsonData($request);

        if ($parsed) {
            $this->requestData = $parsed;
        } else {
            $this->requestJson = $request ?: '{}';
        }

        if (!Str::startsWith($remoteUrl, '`') && !Str::endsWith($remoteUrl, '`')) {
            $this->remoteUrl = Js::from($remoteUrl);
        }


        $parsed = $this->parseJsonData($headers);

        if ($parsed) {
            $this->headers = $parsed;
        } else {
            $this->jsonHeaders = $headers ?: '{}';
        }
    }


    public function isHidden(): bool
    {
        return $this->type === 'hidden';
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('tomato-admin::components.items');
    }
}
