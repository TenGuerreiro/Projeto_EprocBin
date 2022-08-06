<?php

namespace TRF4\UI\Component;


use TRF4\UI\Element\GenericElement;

/**
 * Class InputNumber
 * @package TRF4\UI
 * @method min($number)
 * @method max($number)
 */
abstract class InputNumber extends AbstractInputWithLabel
{
    use Customizable;

    /** @var GenericElement */
    public $_input;
    protected $type = 'number';
}
