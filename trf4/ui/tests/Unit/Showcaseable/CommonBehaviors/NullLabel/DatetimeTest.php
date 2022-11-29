<?php

namespace Tests\Unit\Showcaseable\CommonBehaviors\NullLabel;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class DatetimeTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Componente Datetime sem label
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
                <div class="form-group uic-datetime">
                        <div class='input-group input-group-sm datepicker'>
                            <input class="form-control datetimepicker-input" data-target="#date_withtime_no_label" id="date_withtime_no_label" name="date_withtime_no_label" placeholder="__/__/____ __:__" type="text"/>
                            <div class="input-group-append" data-target="#date_withtime_no_label" data-toggle="datetimepicker">
                                <span class="input-group-text" id="inputGroup-sizing-sm"><i class="material-icons m-0">date_range</i></span>
                            </div>
                        </div>
                        <script>UI.PHPHelper.date.init("date_withtime_no_label", true, null);</script>
                    </div>
html


            ]

        ];
    }

    public function actual(): string
    {
        return UI::datetime(null, 'date_withtime_no_label');
    }
}
