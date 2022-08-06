<?php

namespace Tests\Unit\Showcaseable\Time;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class WithValueTest extends Showcaser
{

    protected $description = <<<MARKDOWN
É possível pré-definir um valor usando o método `value`.
MARKDOWN;
    protected $name = "With Value";

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
                <div class="form-group uic-time">
                        <label for="my_time2">Horário</label>
                        <div class='input-group input-group-sm datepicker'>
                            <input class="form-control datetimepicker-input" data-target="#my_time2" id="my_time2" name="my_time2" placeholder="__:__" type="text"/>
                            <div class="input-group-append" data-target="#my_time2" data-toggle="datetimepicker">
                                <span class="input-group-text" id="inputGroup-sizing-sm"><i class="material-icons m-0">access_time</i></span>
                            </div>
                        </div>
                        <script>UI.PHPHelper.time.init("my_time2", false, "13:30");</script>
                    </div>
html
            ]

        ];
    }

    public function actual(): string
    {
        return UI::time('Horário', 'my_time2')
            ->value('13:30');
    }
}
