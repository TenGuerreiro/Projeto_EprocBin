<?php

namespace Tests\Unit\Showcaseable\CommonBehaviors\Hint\Basic;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class DateIntervalTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Cria um campo preset período(DatePeriod) com hint(tooltip)
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
<div class="form-group uic-date">
    <label class="w-100" for="preset_dateperiodo_hint"> Date Interval <i class="material-icons float-right" data-content="My hint" data-html="false" data-toggle="popover" data-trigger="hover" id="preset_dateperiodo_hint-hint">help_outline</i>
    </label>
    <div class="form-row">
        <div class='input-group input-group-sm datepicker'>
            <input class="form-control datetimepicker-input" data-target="#preset_dateperiodo_hintInicio" id="preset_dateperiodo_hintInicio" placeholder="__/__/____" name="preset_dateperiodo_hintInicio" type="text"/>
            <div class="input-group-append" data-target="#preset_dateperiodo_hintInicio" data-toggle="datetimepicker">
                <span class="input-group-text" id="inputGroup-sizing-sm">
                    <i class="material-icons m-0">date_range</i>
                </span>
            </div>
        </div>
        
        <div class='input-group input-group-sm datepicker'>
            <input class="form-control datetimepicker-input" data-target="#preset_dateperiodo_hintFim" id="preset_dateperiodo_hintFim" placeholder="__/__/____" name="preset_dateperiodo_hintFim" type="text"/>
            <div class="input-group-append" data-target="#preset_dateperiodo_hintFim" data-toggle="datetimepicker"> 
                <span class="input-group-text" id="inputGroup-sizing-sm">
                    <i class="material-icons m-0">date_range</i>
                </span>
            </div>
        </div>
    </div>
</div>
<script>
    UI.PHPHelper.dateInterval.init('preset_dateperiodo_hintInicio', 'preset_dateperiodo_hintFim', false);
    $('#preset_dateperiodo_hint-hint').popover();
</script>

html
            ]

        ];
    }

    public function actual(): string
    {
        return UI::dateInterval('Date Interval', 'preset_dateperiodo_hint')
            ->hint('My hint');
    }
}