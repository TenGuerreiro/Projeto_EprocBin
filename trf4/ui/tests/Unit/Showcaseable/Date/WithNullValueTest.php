<?php

namespace Tests\Unit\Showcaseable\Date;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class WithNullValueTest extends Showcaser
{

    protected $description = <<<MARKDOWN
* Se o `value` parametrizado for nulo, o valor não será definido.
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
                <div class="form-group uic-date">
                    <label for="date_w_null_value">Date</label>
                    <div class='input-group input-group-sm datepicker'>
                        <input class="form-control datetimepicker-input" data-target="#date_w_null_value" id="date_w_null_value" name="date_w_null_value" placeholder="__/__/____" type="text">
                        <div class="input-group-append" data-target="#date_w_null_value" data-toggle="datetimepicker">
                            <span class="input-group-text" id="inputGroup-sizing-sm"><i class="material-icons m-0">date_range</i></span>
                        </div>
                    </div>
                    <script>UI.PHPHelper.date.init("date_w_null_value", false, null);</script>
                </div>
html
            ]
        ];
    }

    public function actual(): string
    {
        return UI::date('Date', 'date_w_null_value')->value(null);
    }
}
