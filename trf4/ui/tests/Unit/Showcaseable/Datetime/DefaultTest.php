<?php

namespace Tests\Unit\Showcaseable\Datetime;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class DefaultTest extends Showcaser
{

    protected $componentMethod = "datetime";

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
                <div class="form-group uic-datetime">
                        <label for="date_withtime">Datetime</label>
                        <div class='input-group input-group-sm datepicker'>
                            <input class="form-control datetimepicker-input" data-target="#date_withtime" id="date_withtime" name="date_withtime" placeholder="__/__/____ __:__" type="text"/>
                            <div class="input-group-append" data-target="#date_withtime" data-toggle="datetimepicker">
                                <span class="input-group-text" id="inputGroup-sizing-sm"><i class="material-icons m-0">date_range</i></span>
                            </div>
                        </div>
                        <script>UI.PHPHelper.date.init("date_withtime", true, null);</script>
                    </div>
html


            ]

        ];
    }

    public function actual(): string
    {
        return UI::datetime('Datetime', 'date_withtime');
    }
}
