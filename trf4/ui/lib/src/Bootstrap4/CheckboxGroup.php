<?php

namespace TRF4\UI\Bootstrap4;

use TRF4\UI\Element\AbstractElement;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class CheckboxGroup extends \TRF4\UI\Component\CheckboxGroup
{
    /** @var AbstractElement */
    public $_wrapper;
    /** @var AbstractElement */
    public $_label;

    public function __construct(string $labelInnerHtml, array $options, ?string $defaultChildrenName = null)
    {
        $this->_wrapper = Bootstrap4::formGroup();
        parent::__construct($labelInnerHtml, $options, $defaultChildrenName);
    }

    public function getDefaultElement(): AbstractElement
    {
        return $this->_wrapper;
    }

    public function render(): string
    {
        $js = "";

        if ($this->hasLabel()) {
            $this->_label = UI::el('span', $this->getLabelText());

            if ($this->isInline()) {
                $this->_label->class('form-check form-check-inline pl-0');
            }
        }

        $checkboxesHtml = $this->checkboxesToHtml();

        $this->buildHintIfIsSet($checkboxesHtml);

        if ($this->_hintWrapper) {
            $checkboxesHtml = $this->_hintWrapper;
        }

        $label = ($this->hasLabel()) ? $this->_label->render() : "";

        if ($this->getHint()) {
            $id = $this->defaultChildrenName;
            $js = <<<html
            <script>
                $('#$id-hint').popover();
            </script>
html;
        }

        $this->_wrapper->innerHTML($label . $checkboxesHtml);

        return $this->_wrapper->render() . $js;
    }

    private function checkboxesToHtml(): string
    {
        $checkboxesHtml = '';
        foreach ($this->options as $checkbox) {
            if (!$checkbox->get('name')) {
                $name = $this->defaultChildrenName;
                $checkbox->name($name);
            }

            if ($this->isInline()) {
                $checkbox->inline();
            }

            $checkbox->isInGroup = true;

            $checkboxesHtml .= $checkbox->render();
        }

        return $checkboxesHtml;
    }
}
