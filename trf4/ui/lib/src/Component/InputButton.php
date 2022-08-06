<?php

namespace TRF4\UI\Component;


abstract class InputButton extends InputText
{
    protected $type = 'button';

    /** @var bool */
    protected $isPrimary = false;

    public function __construct(?string $labelInnerHtml = null)
    {
        parent::__construct($labelInnerHtml);
    }

    public function primary(): self
    {
        $this->isPrimary = true;
        return $this;
    }

    public function isPrimary(): bool
    {
        return $this->isPrimary;
    }
}
