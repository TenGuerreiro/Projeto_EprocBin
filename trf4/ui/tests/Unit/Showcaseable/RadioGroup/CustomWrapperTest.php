<?php

namespace Tests\Unit\Showcaseable\RadioGroup;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class CustomWrapperTest extends Showcaser
{

    protected $description = "`Radios` podem ter seus subcomponentes configurados. ";

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
            <div class="form-group">
                <span>Radio Group</span>
                <div class="custom-control custom-radio" style="border: 1px solid orange;">
                    <input class="custom-control-input" id="customRadio1" name="radio_custom_wrapper" type="radio" value="1"/>
                    <label class="custom-control-label" for="customRadio1">Radio 1</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" id="customRadio2" name="radio_custom_wrapper" type="radio" value="2"/>
                    <label class="custom-control-label" for="customRadio2" style="border: 1px solid orange;">Radio 2</label>
                </div>
            </div>
html
            ]

        ];
    }

    public function actual(): string
    {
        $options = [
            UI::radio('Radio 1', 1, 'customRadio1')->_wrapper('style', "border: 1px solid orange;"),
            UI::radio('Radio 2', 2, 'customRadio2')->_label('style', "border: 1px solid orange;"),
        ];
        return UI::radioGroup('Radio Group', 'radio_custom_wrapper', $options);
    }
}
