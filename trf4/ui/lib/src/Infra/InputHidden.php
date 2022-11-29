<?php


namespace TRF4\UI\Infra;


class InputHidden extends \TRF4\UI\Component\InputHidden
{

    public function __construct(?string $name = null)
    {
        parent::__construct(null, $name);
    }

    protected function buildElements(): void
    {
    }

    protected function assembleAndPrintElements(): string
    {
        return $this->_input->render();
    }
}
