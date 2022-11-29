<?php


namespace TRF4\UI\Bootstrap4;


trait InputButtonActions
{

    public function __construct(?string $labelInnerHtml = null)
    {
        parent::__construct($labelInnerHtml);
    }

    protected function buildElements(): void
    {
        $this->_input->class('btn btn-sm');

        if (!$this->isPrimary()) {
            $this->_input->class('btn-secondary');
        } else {
            $this->_input->class('btn-primary');
        }
    }

    protected function assembleAndPrintElements(): string
    {
        $this->_input->value($this->labelInnerHtml);

        return $this->_input->render();
    }
}
