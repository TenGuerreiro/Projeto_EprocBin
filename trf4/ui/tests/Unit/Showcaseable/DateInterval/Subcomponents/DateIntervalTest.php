<?php

namespace Tests\Unit\Showcaseable\DateInterval\Subcomponents;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class DateIntervalTest extends Showcaser
{
    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
<div class="form-group uic-date" style="border: 2px solid orange;">
    <label for="preset_dateperiodo">Date período</label>
    <div class="form-row">
        <div class='input-group input-group-sm datepicker'>
            <input class="form-control datetimepicker-input" data-target="#preset_dateperiodoInicio" id="preset_dateperiodoInicio" name="preset_dateperiodoInicio" placeholder="__/__/____" type="text"/>
            <div class="input-group-append" data-target="#preset_dateperiodoInicio" data-toggle="datetimepicker">
                <span class="input-group-text" id="inputGroup-sizing-sm">
                    <i class="material-icons m-0">date_range</i>
                </span>
            </div>
        </div>
        <div class='input-group input-group-sm datepicker'>
            <input class="form-control datetimepicker-input" data-target="#preset_dateperiodoFim" id="preset_dateperiodoFim" name="preset_dateperiodoFim" placeholder="__/__/____" type="text"/>
            <div class="input-group-append" data-target="#preset_dateperiodoFim" data-toggle="datetimepicker"> 
                <span class="input-group-text" id="inputGroup-sizing-sm">
                    <i class="material-icons m-0">date_range</i> 
                </span>
            </div>
        </div>
    </div>
</div>
<script>UI.PHPHelper.dateInterval.init('preset_dateperiodoInicio', 'preset_dateperiodoFim', false);</script>
html
            ]

        ];
    }

    public function actual(): string
    {
        return UI::dateInterval('Date período', 'preset_dateperiodo')
            ->_wrapper('style', 'border: 2px solid orange;');
    }
}