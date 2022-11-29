<?php

namespace Tests\Unit\Showcaseable\CommonBehaviors\Hint\Basic;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class DateTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Cria um campo de data com máscara e datepicker com Hint  
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
                <div class="form-group uic-date">
                    <label class="w-100" for="date_default_hint">
                        Date
                        <i class="material-icons float-right"                        
                           data-content="My hint"
                           data-html="false"
                           data-toggle="popover"
                           data-trigger="hover"
                           id="date_default_hint-hint">help_outline</i>
                    </label>
                    <div class='input-group input-group-sm datepicker'>
                        <input class="form-control datetimepicker-input" data-target="#date_default_hint" id="date_default_hint" name="date_default_hint" placeholder="__/__/____" type="text">
                        <div class="input-group-append" data-target="#date_default_hint" data-toggle="datetimepicker">
                            <span class="input-group-text" id="inputGroup-sizing-sm"><i class="material-icons m-0">date_range</i></span>
                        </div>
                    </div>
                    <script>UI.PHPHelper.date.init("date_default_hint", false, null);$('#date_default_hint-hint').popover();</script>
                </div>
html

            ]

        ];
    }

    public function actual(): string
    {
        return UI::date('Date', 'date_default_hint')
            ->hint('My hint');
    }
}
