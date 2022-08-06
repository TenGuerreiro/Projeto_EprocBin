<?php

namespace Tests\Unit\Showcaseable\RadioGroup;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class InlineTest extends Showcaser
{

    protected $description = "Cria um grupo de opções radio com opções alinhada horizontalmente `inline()`";

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
            <div class="form-group">
                <span class="form-radio form-radio-inline pl-0">Radio Group</span>
                <div class="custom-control custom-radio custom-control-inline">
                    <input class="custom-control-input" id="customRadio1" name="radio_inline" type="radio" value="1"/>
                    <label class="custom-control-label" for="customRadio1">Radio 1</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input class="custom-control-input" id="customRadio2" name="radio_inline" type="radio" value="2"/>
                    <label class="custom-control-label" for="customRadio2">Radio 2</label>
                </div>
            </div>
html
            ]

        ];
    }

    public function actual(): string
    {
        $options = [
            UI::radio('Radio 1', 1, 'customRadio1'),
            UI::radio('Radio 2', 2, 'customRadio2'),
        ];
        return UI::radioGroup('Radio Group', 'radio_inline', $options)->inline();
    }
}