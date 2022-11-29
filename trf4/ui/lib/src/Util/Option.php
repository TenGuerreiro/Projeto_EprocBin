<?php


namespace TRF4\UI\Util;


use TRF4\UI\Element\AbstractSimpleElement;

class Option extends AbstractSimpleElement
{

    public function __construct($value, $innerHTML)
    {
        $this->innerHTML = $innerHTML;
        $this->attr('value', $value);

        parent::__construct();
    }

    public function render(): string
    {
        return parent::render();
    }

    public function getTagName(): string
    {
        return 'option';
    }
}
