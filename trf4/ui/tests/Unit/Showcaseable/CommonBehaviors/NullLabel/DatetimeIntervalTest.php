<?php

namespace Tests\Unit\Showcaseable\CommonBehaviors\NullLabel;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class DatetimeIntervalTest extends Showcaser
{

    protected $name = "Nullable label";
    protected $description = <<<MARKDOWN
Cria um campo de intervalo entre datas e horas sem label.
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
<div class="form-group uic-datetime">
    <div class="form-row">
        <div class='input-group input-group-sm datepicker'>
            <input class="form-control datetimepicker-input" data-target="#preset_datetimeperiodo_noLabelInicio" id="preset_datetimeperiodo_noLabelInicio" name="preset_datetimeperiodo_noLabelInicio" placeholder="__/__/____ __:__" type="text"/>
            <div class="input-group-append" data-target="#preset_datetimeperiodo_noLabelInicio" data-toggle="datetimepicker">
                <span class="input-group-text" id="inputGroup-sizing-sm">
                    <i class="material-icons m-0">date_range</i>
                </span></div>
        </div>
        <div class='input-group input-group-sm datepicker'>
            <input class="form-control datetimepicker-input" data-target="#preset_datetimeperiodo_noLabelFim" id="preset_datetimeperiodo_noLabelFim" name="preset_datetimeperiodo_noLabelFim" placeholder="__/__/____ __:__" type="text"/>
            <div class="input-group-append" data-target="#preset_datetimeperiodo_noLabelFim" data-toggle="datetimepicker">
                <span class="input-group-text" id="inputGroup-sizing-sm">
                    <i class="material-icons m-0">date_range</i> 
                </span>
            </div>
        </div>
    </div>
</div>
<script>UI.PHPHelper.dateInterval.init('preset_datetimeperiodo_noLabelInicio', 'preset_datetimeperiodo_noLabelFim', true);</script>
                    
html
            ]

        ];
    }

    public function actual(): string
    {
        return UI::dateTimeInterval(null, 'preset_datetimeperiodo_noLabel');
    }
}