<?php

namespace Tests\Unit\Showcaseable\Time;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class RequiredTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Cria component `Time` com preenchimento obrigatório.
MARKDOWN;
    
    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
                <div class="form-group uic-time">
                        <label for="time_required">Horário<span class="text-danger">*</span></label>
                        <div class='input-group input-group-sm datepicker'>
                            <input class="form-control datetimepicker-input" data-target="#time_required" id="time_required" name="time_required" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" placeholder="__:__" required type="text"/>
                            <div class="input-group-append" data-target="#time_required" data-toggle="datetimepicker">
                                <span class="input-group-text" id="inputGroup-sizing-sm"><i class="material-icons m-0">access_time</i></span>
                            </div>
                            <div class='invalid-feedback'>O campo "Horário" é obrigatório</div>
                        </div>
                        <script>UI.PHPHelper.time.init("time_required", false, null);</script>
                    </div>
html
            ]

        ];
    }

    public function actual(): string
    {
        return UI::time('Horário', 'time_required')->required();
    }
}
