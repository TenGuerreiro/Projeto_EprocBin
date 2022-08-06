<?php

namespace Tests\Unit\Showcaseable\Date;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class RequiredTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Cria um campo de data com preenchimento obrigatório.
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
                <div class="form-group uic-date">
                    <label for="date_required">Date<span class="text-danger">*</span></label>
                    <div class='input-group input-group-sm datepicker'>
                        <input class="form-control datetimepicker-input" data-target="#date_required" 
                            id="date_required" name="date_required" placeholder="__/__/____" 
                            pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d" required type="text">
                        <div class="input-group-append" data-target="#date_required" data-toggle="datetimepicker">
                            <span class="input-group-text" id="inputGroup-sizing-sm"><i class="material-icons m-0">date_range</i></span>
                        </div>
                        <div class='invalid-feedback'>O campo "Date" é obrigatório</div>
                    </div>
                    <script>UI.PHPHelper.date.init("date_required", false, null);</script>
                </div>
html


            ]

        ];
    }

    public function actual(): string
    {
        return UI::date('Date', 'date_required')->required();
    }
}
