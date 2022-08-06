<?php


namespace TRF4\UI\Renderer;


use TRF4\UI\Element\GenericElement;
use TRF4\UI\Infra\Alert;
use TRF4\UI\Infra\Button;
use TRF4\UI\Infra\Checkbox;
use TRF4\UI\Infra\CheckboxGroup;
use TRF4\UI\Infra\Date;
use TRF4\UI\Infra\DateInterval;
use TRF4\UI\Infra\FileUpload;
use TRF4\UI\Infra\InputButton;
use TRF4\UI\Infra\InputHidden;
use TRF4\UI\Infra\InputNumber;
use TRF4\UI\Infra\InputReset;
use TRF4\UI\Infra\InputSubmit;
use TRF4\UI\Infra\InputText;
use TRF4\UI\Infra\MultiRange;
use TRF4\UI\Infra\MultiSelect;
use TRF4\UI\Infra\Radio;
use TRF4\UI\Infra\RadioGroup;
use TRF4\UI\Infra\Range;
use TRF4\UI\Infra\Select;
use TRF4\UI\Infra\Table;
use TRF4\UI\Infra\Textarea;
use TRF4\UI\Labeled\AbstractElementWithLabel;

class Infra extends AbstractRenderer
{

    public static function createLabelFor(AbstractElementWithLabel $el): GenericElement
    {
        $label = parent::createLabelFor($el);
        $label->class('infraLabelOpcional');
        return $label;
    }

    public function getMultiAutocompleteClass(): string
    {
        throw new \Exception('MultiAutocomplete not implemented');
    }

    public function getAutocompleteClass(): string
    {
        throw new \Exception('Autocomplete not implemented');
    }

    public function getAlertClass(): string
    {
        return Alert::class;
    }

    public function getButtonClass(): string
    {
        return Button::class;
    }

    public function getCheckboxClass(): string
    {
        return Checkbox::class;
    }

    public function getDateClass(): string
    {
        return Date::class;
    }

    public function getTimeClass(): string
    {
        // return Date::class;
    }

    public function getDateIntervalClass(): string
    {
        return DateInterval::class;
    }

    public function getIconButtonClass(): string
    {
        // TODO: Implement getIconButtonClass() method.
    }

    public function getInputTextClass(): string
    {
        return InputText::class;
    }

    public function getInputHiddenClass(): string
    {
        return InputHidden::class;
    }

    public function getInputNumberClass(): string
    {
        return InputNumber::class;
    }

    public function getInputButtonClass(): string
    {
        return InputButton::class;
    }

    public function getInputResetClass(): string
    {
        return InputReset::class;
    }

    public function getInputSubmitClass(): string
    {
        return InputSubmit::class;
    }

    public function getInputMaskClass(): string
    {
        // TODO: Implement getInputMaskClass() method.
    }

    public function getRadioClass(): string
    {
        return Radio::class;
    }

    public function getRadioGroupClass(): string
    {
        return RadioGroup::class;
    }

    public function getSelectClass(): string
    {
        return Select::class;
    }

    public function getMultiSelectClass(): string
    {
        return MultiSelect::class;
    }

    public function getTableClass(): string
    {
        return Table::class;
    }

    public function getTextareaClass(): string
    {
        return Textarea::class;
    }

    public function getFileUploadClass(): string
    {
        return FileUpload::class;
    }

    public function getRangeClass(): string
    {
        return Range::class;
    }

    public function getMultiRangeClass(): string
    {
        return MultiRange::class;
    }

    public function getCheckboxGroupClass(): string
    {
        return CheckboxGroup::class;
    }

    public function checkbox(\TRF4\UI\Labeled\Checkbox $checkbox): string
    {
        return Checkbox::class;
    }
}
