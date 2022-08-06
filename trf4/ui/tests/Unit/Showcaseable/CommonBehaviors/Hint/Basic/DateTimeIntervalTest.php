<?php

namespace Tests\Unit\Showcaseable\CommonBehaviors\Hint\Basic;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class DateTimeIntervalTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Cria um campo período(DatePeriod) com tempo(withTime), com hint(tooltip)
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
                <div class="form-group uic-datetime">
                    <label class="w-100" for="date_interval_w_time_hint">
                        Datetime Interval
                        <i class="material-icons float-right" data-content="My hint" data-html="false" data-toggle="popover" data-trigger="hover" id="date_interval_w_time_hint-hint">help_outline</i>
                    </label>
                    <div class="form-row">
                        <div class='input-group input-group-sm datepicker'>
                            <input class="form-control datetimepicker-input" data-target="#date_interval_w_time_hintInicio" id="date_interval_w_time_hintInicio" name="date_interval_w_time_hintInicio" placeholder="__/__/____ __:__" type="text" />
                            <div class="input-group-append" data-target="#date_interval_w_time_hintInicio" data-toggle="datetimepicker">
                                <span class="input-group-text" id="inputGroup-sizing-sm"> <i class="material-icons m-0">date_range</i> </span>
                            </div>
                        </div>
                        <div class='input-group input-group-sm datepicker'>
                            <input class="form-control datetimepicker-input" data-target="#date_interval_w_time_hintFim" id="date_interval_w_time_hintFim" name="date_interval_w_time_hintFim" placeholder="__/__/____ __:__" type="text" />
                            <div class="input-group-append" data-target="#date_interval_w_time_hintFim" data-toggle="datetimepicker">
                                <span class="input-group-text" id="inputGroup-sizing-sm"> <i class="material-icons m-0">date_range</i> </span>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    UI.PHPHelper.dateInterval.init('date_interval_w_time_hintInicio', 'date_interval_w_time_hintFim', true);$('#date_interval_w_time_hint-hint').popover();
                </script>
html
            ]

        ];
    }

    public function actual(): string
    {
        return UI::dateTimeInterval('Datetime Interval', 'date_interval_w_time_hint')
            ->hint('My hint');
    }
}