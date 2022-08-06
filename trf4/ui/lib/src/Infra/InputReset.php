<?php


namespace TRF4\UI\Infra;


use TRF4\UI\Element\GenericElement;

class InputReset extends \TRF4\UI\Component\InputReset
{
    /** @var GenericElement */
    public $_wrapper;

    public function __construct(?string $labelInnerHtml)
    {
        parent::__construct($labelInnerHtml);
        $this->class('infraButton');
    }


    protected function buildElements(): void
    {
        $this->_input->value($this->labelInnerHtml);
    }

    protected function assembleAndPrintElements(): string
    {
        return $this->_input->render();
    }
}
