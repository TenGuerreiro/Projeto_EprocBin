<?php

namespace Tests\Unit\Showcaseable\Date;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class WithTimeAndValueTest extends Showcaser
{
    
    protected $description = <<<MARKDOWN
Com o método `value(\$value)`, pode-se definir o valor inicial seguindo o formato `DD/MM/YYYY HH:mm`.
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
                <div class="form-group uic-datetime">
                    <label for="datetime_w_value">Datetime</label>
                    <div class='input-group input-group-sm datepicker'>
                        <input class="form-control datetimepicker-input" data-target="#datetime_w_value" id="datetime_w_value" name="datetime_w_value" placeholder="__/__/____ __:__" type="text">
                        <div class="input-group-append" data-target="#datetime_w_value" data-toggle="datetimepicker">
                            <span class="input-group-text" id="inputGroup-sizing-sm"><i class="material-icons m-0">date_range</i></span>
                        </div>
                    </div>
                    <script>UI.PHPHelper.date.init("datetime_w_value", true, "19\/02\/1993 12:35");</script>
                </div>
html
            ]
        ];
    }

    public function actual(): string
    {
        return UI::datetime('Datetime', 'datetime_w_value')->value('19/02/1993 12:35');
    }
}
