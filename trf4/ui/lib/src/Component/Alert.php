<?php

namespace TRF4\UI\Component;

use TRF4\UI\Element\Component;

abstract class Alert extends Component
{
    public const TYPE_SECONDARY = 0;
    public const TYPE_SUCCESS = 1;
    public const TYPE_DANGER = 2;
    public const TYPE_INFO = 3;
    public const TYPE_WARNING = 4;
    /** @var boolean */
    public $isDismissible = false;
    /** @var string */
    public $innerHTML;
    /** @var int */
    public $type;

    public function __construct(string $innerHTML)
    {
        $this->innerHTML = $innerHTML;
    }

    public function danger(): self
    {
        $this->type = self::TYPE_DANGER;
        return $this;
    }

    public function info(): self
    {
        $this->type = self::TYPE_INFO;
        return $this;
    }

    public function secondary(): self
    {
        $this->type = self::TYPE_SECONDARY;
        return $this;
    }

    public function success(): self
    {
        $this->type = self::TYPE_SUCCESS;
        return $this;
    }

    public function dismissible(): self
    {
        $this->isDismissible = true;
        return $this;
    }

    public function warning(): self
    {
        $this->type = self::TYPE_WARNING;
        return $this;
    }

}
