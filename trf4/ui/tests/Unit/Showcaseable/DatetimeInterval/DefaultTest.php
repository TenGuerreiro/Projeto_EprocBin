<?php

namespace Tests\Unit\Showcaseable\DatetimeInterval;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class DefaultTest extends Showcaser
{

    
    protected $componentMethod = "dateTimeInterval";

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
<div class="form-group uic-datetime">
    <label for="preset_datetimeperiodo">Datetime Interval</label>
    <div class="form-row">
        <div class='input-group input-group-sm datepicker'>
            <input class="form-control datetimepicker-input" data-target="#preset_datetimeperiodoInicio" id="preset_datetimeperiodoInicio" name="preset_datetimeperiodoInicio" placeholder="__/__/____ __:__" type="text"/>
            <div class="input-group-append" data-target="#preset_datetimeperiodoInicio" data-toggle="datetimepicker">
                <span class="input-group-text" id="inputGroup-sizing-sm">
                    <i class="material-icons m-0">date_range</i>
                </span></div>
        </div>
        <div class='input-group input-group-sm datepicker'>
            <input class="form-control datetimepicker-input" data-target="#preset_datetimeperiodoFim" id="preset_datetimeperiodoFim" name="preset_datetimeperiodoFim" placeholder="__/__/____ __:__" type="text"/>
            <div class="input-group-append" data-target="#preset_datetimeperiodoFim" data-toggle="datetimepicker">
                <span class="input-group-text" id="inputGroup-sizing-sm">
                    <i class="material-icons m-0">date_range</i> 
                </span>
            </div>
        </div>
    </div>
</div>
<script>UI.PHPHelper.dateInterval.init('preset_datetimeperiodoInicio', 'preset_datetimeperiodoFim', true);</script>
                    
html
            ]

        ];
    }

    public function actual(): string
    {
        return UI::dateTimeInterval('Datetime Interval', 'preset_datetimeperiodo');
    }
}