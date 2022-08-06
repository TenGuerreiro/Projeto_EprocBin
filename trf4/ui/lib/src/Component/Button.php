<?php


namespace TRF4\UI\Component;


use TRF4\UI\Element\AbstractSimpleElement;
use TRF4\UI\Util\Internal;

abstract class Button extends AbstractSimpleElement
{
    /** @var bool */
    protected $isPrimary = false;

    public function getTagName(): string
    {
        return 'button';
    }

    public function __construct(string $innerHTML)
    {
        $this->innerHTML($innerHTML);
        parent::__construct();
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

    public function accesskey(string $char): self
    {
        $this->innerHTML(Internal::addAccesskeyTagToString($this->innerHTML, $char));
        $this->attr('accesskey', $char);
        return $this;
    }

}
