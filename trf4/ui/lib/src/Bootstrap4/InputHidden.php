<?php


namespace TRF4\UI\Bootstrap4;


class InputHidden extends \TRF4\UI\Component\InputHidden
{
    public function __construct(?string $name = null, ?string $value = null)
    {
        parent::__construct(null, $name);

        if ($value) {
            $this->value($value);
        }
    }

    protected function buildElements(): void
    {
    }

    protected function assembleAndPrintElements(): string
    {
        return $this->_input->render();
    }
}
