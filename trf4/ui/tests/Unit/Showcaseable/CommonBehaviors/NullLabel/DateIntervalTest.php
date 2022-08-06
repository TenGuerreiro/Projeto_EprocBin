<?php

namespace Tests\Unit\Showcaseable\CommonBehaviors\NullLabel;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class DateIntervalTest extends Showcaser
{

    protected $name = "Nullable label";
    protected $description = <<<MARKDOWN
Cria um campo de intervalo entre datas sem label.
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
<div class="form-group uic-date">
    <div class="form-row">
        <div class='input-group input-group-sm datepicker'>
            <input class="form-control datetimepicker-input" data-target="#preset_dateperiodo_no_labelInicio" id="preset_dateperiodo_no_labelInicio" name="preset_dateperiodo_no_labelInicio" placeholder="__/__/____" type="text" />
            <div class="input-group-append" data-target="#preset_dateperiodo_no_labelInicio" data-toggle="datetimepicker">
                <span class="input-group-text" id="inputGroup-sizing-sm"> <i class="material-icons m-0">date_range</i> </span>
            </div>
        </div>
        <div class='input-group input-group-sm datepicker'>
            <input class="form-control datetimepicker-input" data-target="#preset_dateperiodo_no_labelFim" id="preset_dateperiodo_no_labelFim" name="preset_dateperiodo_no_labelFim" placeholder="__/__/____" type="text" />
            <div class="input-group-append" data-target="#preset_dateperiodo_no_labelFim" data-toggle="datetimepicker">
                <span class="input-group-text" id="inputGroup-sizing-sm"> <i class="material-icons m-0">date_range</i> </span>
            </div>
        </div>
    </div>
</div>
<script>
    UI.PHPHelper.dateInterval.init('preset_dateperiodo_no_labelInicio', 'preset_dateperiodo_no_labelFim', false);
</script>
                    
html
            ]

        ];
    }

    public function actual(): string
    {
        return UI::dateInterval(null, 'preset_dateperiodo_no_label');
    }
}