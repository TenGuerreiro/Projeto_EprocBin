<?php

namespace Tests\Unit\Showcaseable\Date;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class DefaultTest extends Showcaser
{

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
                <div class="form-group uic-date">
                    <label for="date_default">Date</label>
                    <div class='input-group input-group-sm datepicker'>
                        <input class="form-control datetimepicker-input" data-target="#date_default" id="date_default" name="date_default" placeholder="__/__/____" type="text">
                        <div class="input-group-append" data-target="#date_default" data-toggle="datetimepicker">
                            <span class="input-group-text" id="inputGroup-sizing-sm"><i class="material-icons m-0">date_range</i></span>
                        </div>
                    </div>
                    <script>UI.PHPHelper.date.init("date_default", false, null);</script>
                </div>
html
            ]

        ];
    }

    public function actual(): string
    {
        return UI::date('Date', 'date_default');
    }
}
