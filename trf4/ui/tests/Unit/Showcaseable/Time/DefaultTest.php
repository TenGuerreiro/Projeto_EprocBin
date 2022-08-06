<?php

namespace Tests\Unit\Showcaseable\Time;

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
                <div class="form-group uic-time">
                        <label for="my_time">Horário</label>
                        <div class='input-group input-group-sm datepicker'>
                            <input class="form-control datetimepicker-input" data-target="#my_time" id="my_time" name="my_time" placeholder="__:__" type="text"/>
                            <div class="input-group-append" data-target="#my_time" data-toggle="datetimepicker">
                                <span class="input-group-text" id="inputGroup-sizing-sm"><i class="material-icons m-0">access_time</i></span>
                            </div>
                        </div>
                        <script>UI.PHPHelper.time.init("my_time", false, null);</script>
                    </div>
html
            ]

        ];
    }

    public function actual(): string
    {
        return UI::time('Horário', 'my_time');
    }
}
