<?php

namespace TRF4\UI\Bootstrap4;


use TRF4\UI\Component\Date as BaseDate;

class Date extends BaseDate
{

    protected $pattern = "(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d";
    protected $patternWithTime = "(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d ([0-9]|0[0-9]|1[0-9]|2[0-3]):([0-9]|[0-5][0-9])$";
    protected $jsComponentName = 'date';
    protected $icon = 'date_range';

    use DateTimeActions;

    public function getPattern(): string
    {
        return $this->withTime ? $this->patternWithTime : $this->pattern;
    }

    public function getJSWithTimeParam(): bool
    {
        return $this->withTime;
    }

    public function getPlaceholder(): string
    {
        $placeholder = "__/__/____";

        if ($this->withTime) {
            $placeholder .= " __:__";
        }

        return $placeholder;
    }

    public function getAdditionalWrapperClass(): string
    {
        return $this->withTime ? 'uic-datetime' : 'uic-date';
    }
}