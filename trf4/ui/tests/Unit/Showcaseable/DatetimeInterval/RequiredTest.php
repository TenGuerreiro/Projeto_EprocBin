<?php

namespace Tests\Unit\Showcaseable\DatetimeInterval;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class RequiredTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Cria um campo preset período(DateTimePeriod) data/hora obrigatório(required), com máscara(mask) e padrão de validação (pattern)
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
<div class="form-group uic-datetime">
    <label for="preset_datetimeperiodo_required">Datetime Interval<span class="text-danger">*</span></label>
    <div class="form-row">
        <div class='input-group input-group-sm datepicker'>
            <input class="form-control datetimepicker-input" data-target="#preset_datetimeperiodo_requiredInicio" id="preset_datetimeperiodo_requiredInicio" name="preset_datetimeperiodo_requiredInicio" pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d ([0-9]|0[0-9]|1[0-9]|2[0-3]):([0-9]|[0-5][0-9])$" placeholder="__/__/____ __:__" type="text"/>
            <div class="input-group-append" data-target="#preset_datetimeperiodo_requiredInicio" data-toggle="datetimepicker"><span class="input-group-text" id="inputGroup-sizing-sm"> <i class="material-icons m-0">date_range</i> </span></div>
        </div>
        <div class='input-group input-group-sm datepicker'>
            <input class="form-control datetimepicker-input" data-target="#preset_datetimeperiodo_requiredFim" id="preset_datetimeperiodo_requiredFim" name="preset_datetimeperiodo_requiredFim" pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d ([0-9]|0[0-9]|1[0-9]|2[0-3]):([0-9]|[0-5][0-9])$" placeholder="__/__/____ __:__" type="text"/>
            <div class="input-group-append" data-target="#preset_datetimeperiodo_requiredFim" data-toggle="datetimepicker"><span class="input-group-text" id="inputGroup-sizing-sm"> <i class="material-icons m-0">date_range</i> </span>
            </div>
        </div>
    </div>
    <div class='invalid-feedback'>O campo "Datetime Interval" é obrigatório</div>
</div>
<script>UI.PHPHelper.dateInterval.init('preset_datetimeperiodo_requiredInicio', 'preset_datetimeperiodo_requiredFim', true);</script>
html
            ]

        ];
    }

    public function actual(): string
    {
        return UI::dateTimeInterval('Datetime Interval', 'preset_datetimeperiodo_required')->required();
    }
}