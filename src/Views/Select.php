<?php

namespace TomatoPHP\TomatoAdmin\Views;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Js;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use ProtoneMedia\Splade\Components\Form;
use ProtoneMedia\Splade\Components\Form\InteractsWithFormElement;
use ProtoneMedia\Splade\FormSelectOption;

class Select extends Component
{
    use InteractsWithFormElement;

    private static bool|array $defaultChoicesOptions = false;

    private static bool $defaultResetOnNewRemoteUrl = false;

    private static bool $defaultSelectFirstRemoteOption = false;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $name = '',
        public string $vModel = '',
        public $options = [],
        public string $type = 'select',
        public string $label = '',
        public bool|string $placeholder = '',
        public bool $multiple = false,
        public string $validationKey = '',
        public bool $showErrors = true,
        public bool $relation = false,
        public string $help = '',
        public ?string $remoteUrl = '',
        public ?string $remoteRoot = '',
        public string $optionValue = '',
        public string $optionLabel = '',
        public string $scope = 'select',
        public bool|null $resetOnNewRemoteUrl = null,
        public bool|null $selectFirstRemoteOption = null,
        public bool $alwaysEnablePrepend = false,
        public bool $alwaysEnableAppend = false,
        public string $prepend = '',
        public string $append = '',
        public int $paginated = 10,
        public string $queryBy = 'search',
        public ?string $loadMoreLabel=null,
    ) {
        if(!$loadMoreLabel){
            $this->loadMoreLabel = __('Load More');
        }
        if ($placeholder === true) {
            $this->placeholder = __('Search') . '...';
        }


        Form::allowAttribute($name);

        if ($relation) {
            Form::parseEloquentRelation($name);
        }

        if ($multiple) {
            // This removes the last '[]' from the name.
            $this->validationKey = static::dottedName($name);
        }

        if (!Str::startsWith($remoteUrl, '`') && !Str::endsWith($remoteUrl, '`')) {
            $this->remoteUrl = Js::from($remoteUrl);
        }

        if (!Str::startsWith($remoteUrl, '`') && !Str::endsWith($remoteUrl, '`')) {
            $this->remoteUrl = Js::from($remoteUrl);
        }

        $this->resetOnNewRemoteUrl = is_bool($resetOnNewRemoteUrl)
            ? $resetOnNewRemoteUrl
            : static::$defaultResetOnNewRemoteUrl;

        $this->selectFirstRemoteOption = is_bool($selectFirstRemoteOption)
            ? $selectFirstRemoteOption
            : static::$defaultSelectFirstRemoteOption;
    }

    /**
     * Enable Choices.js globally for all selects elements, optionally with default options.
     *
     * @return void
     */
    public static function defaultChoices(bool|array $options = true)
    {
        static::$defaultChoicesOptions = $options;
    }

    /**
     * Set the default value for the resetOnNewRemoteUrl property.
     */
    public static function defaultResetOnNewRemoteUrl(bool $value = true)
    {
        static::$defaultResetOnNewRemoteUrl = $value;
    }

    /**
     * Set the default value for the selectFirstRemoteOption property.
     */
    public static function defaultSelectFirstRemoteOption(bool $value = true)
    {
        static::$defaultSelectFirstRemoteOption = $value;
    }

    /**
     * Determines whether the given value is selected. It's a
     * workaround for a Vue bug. See also Form::selected().
     *
     * @param  mixed  $value
     */
    public function selected($value): bool
    {
        return Form::selected($this->name, $value);
    }


    /**
     * Returns a boolean whether the input type is 'hidden'.
     *
     * @return bool
     */
    public function isHidden(): bool
    {
        return $this->type === 'hidden';
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('tomato-admin::components.select');
    }
}
