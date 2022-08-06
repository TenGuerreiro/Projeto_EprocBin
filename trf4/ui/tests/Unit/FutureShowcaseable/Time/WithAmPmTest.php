<?php

namespace Tests\Unit\FutureShowcaseable\Time;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class WithAmPmTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Cria um campo de tempo com máscara e timepicker com formato AM/PM <br> 
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
                <div class="form-group uic-time">
                        <label for="my_time_ampm">Horário AM/PM</label>
                        <div class='input-group input-group-sm datepicker'>
                            <input class="form-control datetimepicker-input" data-target="#my_time_ampm" id="my_time_ampm" name="my_time_ampm" placeholder="__:__" type="text"/>
                            <div class="input-group-append" data-target="#my_time_ampm" data-toggle="datetimepicker">
                                <span class="input-group-text" id="inputGroup-sizing-sm"><i class="material-icons m-0">access_time</i></span>
                            </div>
                        </div>
                        <script>UI.PHPHelper.time.init("my_time_ampm", true, null);</script>
                    </div>
html
            ]

        ];
    }

    public function actual(): string
    {
        return UI::time('Horário AM/PM', 'my_time_ampm')->isAmPm();
    }
}
