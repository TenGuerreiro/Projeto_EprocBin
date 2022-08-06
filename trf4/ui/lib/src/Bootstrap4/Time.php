<?php

namespace TRF4\UI\Bootstrap4;


use TRF4\UI\Component\Time as BaseTime;

class Time extends BaseTime
{

    protected $withTime = true;
    protected $pattern = "([01]?[0-9]|2[0-3]):[0-5][0-9]";
    protected $jsComponentName = 'time';
    protected $icon = 'access_time';

    use DateTimeActions;

    public function getPattern(): string
    {
        return $this->pattern;
    }

    public function getJSWithTimeParam(): bool
    {
        return $this->isAmPm;
    }

    public function getPlaceholder(): string
    {
        return '__:__';
    }

    public function getAdditionalWrapperClass(): string
    {
        return 'uic-time';
    }
}
