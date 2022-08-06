<?php


namespace TRF4\UI\Bootstrap4;


use TRF4\UI\UI;

class InputSubmit extends \TRF4\UI\Component\InputSubmit
{
    use InputButtonActions;

    public function __construct(?string $labelInnerHtml = null)
    {
        parent::__construct($labelInnerHtml);

        $this->_wrapper = UI::el('div')->class('form-group');

        $this->primary();
    }

}
