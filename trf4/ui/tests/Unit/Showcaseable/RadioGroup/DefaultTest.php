<?php

namespace Tests\Unit\Showcaseable\RadioGroup;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class DefaultTest extends Showcaser
{

    protected $description = "Cria um grupo de opções radio";

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
            <div class="form-group">
                <span>Radio Group</span>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" id="customRadio1" name="radio_default" type="radio" value="1"/>
                    <label class="custom-control-label" for="customRadio1">Radio 1</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" id="customRadio2" name="radio_default" type="radio" value="2"/>
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
        return UI::radioGroup('Radio Group', 'radio_default', $options);
    }
}
