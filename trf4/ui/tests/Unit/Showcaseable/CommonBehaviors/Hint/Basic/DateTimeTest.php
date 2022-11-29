<?php

namespace Tests\Unit\Showcaseable\CommonBehaviors\Hint\Basic;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class DateTimeTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Cria um campo de data com máscara e datepicker com Hint  
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
               <div class="form-group uic-datetime">
                    <label class="w-100" for="datetime_hint">Datetime<i class="material-icons float-right" data-content="My hint" data-html="false" data-toggle="popover" data-trigger="hover" id="datetime_hint-hint">help_outline</i></label>
                    <div class='input-group input-group-sm datepicker'>
                        <input class="form-control datetimepicker-input" data-target="#datetime_hint" id="datetime_hint" name="datetime_hint" placeholder="__/__/____ __:__" type="text">
                        <div class="input-group-append" data-target="#datetime_hint" data-toggle="datetimepicker">
                            <span class="input-group-text" id="inputGroup-sizing-sm">
                                <i class="material-icons m-0">date_range</i>
                            </span>
                        </div>
                    </div>
                    <script>UI.PHPHelper.date.init("datetime_hint", true, null);$('#datetime_hint-hint').popover();</script>
                </div>
html

            ]

        ];
    }

    public function actual(): string
    {
        return UI::datetime('Datetime', 'datetime_hint')
            ->hint('My hint');
    }
}
