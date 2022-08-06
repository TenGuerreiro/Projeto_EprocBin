<?php


namespace TRF4\UI\Component;


use TRF4\UI\Element\AbstractElement;
use TRF4\UI\Labeled\AbstractElementWithLabel;
use TRF4\UI\UI;

abstract class Time extends AbstractElementWithLabel
{
    /** @var AbstractElement */
    public $_input;
    /** @var bool */
    protected $isAmPm = false;

    public function __construct(string $labelInnerHtml, string $name)
    {
        parent::__construct($labelInnerHtml);

        $this->_input = UI::el('input');
        $this->type('text');
        $this->name($name);
    }

    public function isAmPm(): self
    {
        $this->isAmPm = true;
        return $this;
    }

    public function getDefaultElement(): AbstractElement
    {
        return $this->_input;
    }

}
