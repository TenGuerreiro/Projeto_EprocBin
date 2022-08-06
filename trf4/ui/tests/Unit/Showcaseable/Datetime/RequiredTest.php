<?php

namespace Tests\Unit\Showcaseable\Datetime;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class RequiredTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Usando o método `withTime()`, com preenchimento obrigatório. Acrescenta-se espaço para horas tanto no datepicker quanto na máscara do input.<br>
MARKDOWN;
    
    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
                <div class="form-group uic-datetime">
                        <label for="date_withtime_required">Datetime<span class="text-danger">*</span></label>
                        <div class='input-group input-group-sm datepicker'>
                            <input class="form-control datetimepicker-input" data-target="#date_withtime_required" id="date_withtime_required" name="date_withtime_required" pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d ([0-9]|0[0-9]|1[0-9]|2[0-3]):([0-9]|[0-5][0-9])$" placeholder="__/__/____ __:__" required type="text"/>
                            <div class="input-group-append" data-target="#date_withtime_required" data-toggle="datetimepicker">
                                <span class="input-group-text" id="inputGroup-sizing-sm"><i class="material-icons m-0">date_range</i></span>
                            </div>
                            <div class='invalid-feedback'>O campo "Datetime" é obrigatório</div>
                        </div>
                        <script>UI.PHPHelper.date.init("date_withtime_required", true, null);</script>
                    </div>
html


            ]

        ];
    }

    public function actual(): string
    {
        return UI::datetime('Datetime', 'date_withtime_required')->required();
    }
}
