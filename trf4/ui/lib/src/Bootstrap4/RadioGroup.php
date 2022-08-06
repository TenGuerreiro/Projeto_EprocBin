<?php

namespace TRF4\UI\Bootstrap4;

use TRF4\UI\Element\AbstractElement;
use TRF4\UI\Element\AbstractSimpleElement;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class RadioGroup extends \TRF4\UI\Component\RadioGroup
{


    /**
     * @var AbstractSimpleElement
     */
    public $_wrapper;
    /** @var AbstractElement */
    public $_label;

    public function getDefaultElement(): AbstractElement
    {
        return $this->_wrapper;
    }

    public function __construct(?string $labelInnerHtml, string $name, array $options)
    {
        parent::__construct($labelInnerHtml, $name, $options);
        $this->_wrapper = Bootstrap4::formGroup();
    }

    public function render(): string
    {
        $radiosHtml = '';
        $js = "";

        if ($this->hasLabel()) {
            $this->_label = UI::el('span', $this->getLabelText());

            if($this->isInline()) {
                $this->_label->class('form-radio form-radio-inline pl-0');                
            }
            
            if ($this->isRequired()) {
                $this->_label->append('<span class="text-danger">*</span>');
            }
        }

        foreach ($this->getOptions() as $radio) {
            $radio->name($this->defaultChildrenName);

            if ($this->isRequired()) {
                $radio->required();
            }

            if($this->isInline()) {
                $radio->inline();
            }

            $radiosHtml .= $radio->render();
        }

        $this->buildHintIfIsSet($radiosHtml);

        if ($this->_hintWrapper) {
            $radiosHtml = $this->_hintWrapper;
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

        $this->_wrapper->innerHTML($label . $radiosHtml . Bootstrap4::getFeedbackForInvalidValue($this));

        return $this->_wrapper->render() . $js;
    }


}
