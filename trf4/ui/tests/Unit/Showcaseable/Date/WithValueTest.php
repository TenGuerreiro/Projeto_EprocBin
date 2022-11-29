<?php

namespace Tests\Unit\Showcaseable\Date;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class WithValueTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Com o método `value(\$value)`, pode-se definir o valor inicial seguindo o formato `DD/MM/YYYY`.
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
                <div class="form-group uic-date">
                    <label for="date_w_value">Date</label>
                    <div class='input-group input-group-sm datepicker'>
                        <input class="form-control datetimepicker-input" data-target="#date_w_value" id="date_w_value" name="date_w_value" placeholder="__/__/____" type="text">
                        <div class="input-group-append" data-target="#date_w_value" data-toggle="datetimepicker">
                            <span class="input-group-text" id="inputGroup-sizing-sm"><i class="material-icons m-0">date_range</i></span>
                        </div>
                    </div>
                    <script>UI.PHPHelper.date.init("date_w_value", false, "19\/02\/1993");</script>
                </div>
html
            ]
        ];
    }

    public function actual(): string
    {
        return UI::date('Date', 'date_w_value')->value('19/02/1993');
    }
}
