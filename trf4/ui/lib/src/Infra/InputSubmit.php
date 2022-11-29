<?php


namespace TRF4\UI\Infra;


use TRF4\UI\Element\GenericElement;

class InputSubmit extends \TRF4\UI\Component\InputSubmit
{
    /** @var GenericElement */
    public $_wrapper;

    public function __construct(?string $labelInnerHtml)
    {
        parent::__construct($labelInnerHtml);
        $this->class('infraSubmit');
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
