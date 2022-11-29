<?php

namespace TRF4\UI\Bootstrap4;


use TRF4\UI\Element\GenericElement;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

trait DateTimeActions
{

    /** @var GenericElement */
    public $_wrapper;

    /**
     * @internal
     * @var string|null
     */
    public $value = null;

    abstract public function getPattern(): string;

    abstract public function getJSWithTimeParam(): bool;

    abstract public function getPlaceholder(): string;

    abstract public function getAdditionalWrapperClass(): string;


    public function __construct(?string $label = null, string $name)
    {
        parent::__construct($label, $name);

        $this->_wrapper = UI::el('div')->class('form-group');
    }

    public function value(?string $value)
    {
        $this->value = $value;
        return $this;
    }

    protected function setAdditionalWrapperClass(): void
    {
        $this->_wrapper->class($this->getAdditionalWrapperClass());
    }

    public function render(): string
    {
        $date = $this;
        $this->setAdditionalWrapperClass();

        $this->buildHintIfIsSet();

        if ($this->_hintWrapper) {
            $date->_input = $this->_hintWrapper;
        }

        $html = $this->renderInput($date);

        $withTime = json_encode($this->getJSWithTimeParam());

        $inputId = json_encode($date->getAttrId());
        $value = json_encode($date->value);

        $label = "";
        if($this->hasLabel()) {
            Bootstrap4::transformLabel($this);
            $label = $this->_label->render();
        }

        $scripts = implode('', $this->scripts);

        $type = $this->jsComponentName;

        $html .= <<<JS
<script>
    UI.PHPHelper.$type.init($inputId, $withTime, $value);$scripts
</script>
JS;
        $this->_wrapper->innerHTML(
            $label .
            $html
        );
        return $this->_wrapper->render();
    }

    protected function renderInput($date)
    {
        $inputId = $date->getAttrId();

        $date->class('form-control datetimepicker-input')
            ->dataTarget("#$inputId");

        if (!$this->get('placeholder')) {
            $date->placeholder($this->getPlaceholder());
        }

        $feedback = Bootstrap4::getFeedbackForInvalidValue($date);
        $pattern = $this->getPattern();

        if ($this->isRequired()) {
            $date->attr("pattern", $pattern);
        }

        $icon = $this->icon;

        $inputHTML = $date->_input->render();
        return <<<HTML
            <div class='input-group input-group-sm datepicker'>
                $inputHTML
                <div class="input-group-append" data-target="#$inputId" data-toggle="datetimepicker">

                    <span class="input-group-text" id="inputGroup-sizing-sm">
                        <i class="material-icons m-0">$icon</i>
                    </span>
                </div>
                $feedback
            </div>
HTML;
    }

}
