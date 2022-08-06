<?php

namespace Tests\Unit\Showcaseable\CommonBehaviors\Hint\Basic;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class RadioGroupTest extends Showcaser
{

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
            <div class="form-group">
                <span class="w-100">
                    Radio Group
                    <i class="material-icons float-right"                        
                        data-content="My hint"
                        data-html="false"
                        data-toggle="popover"
                        data-trigger="hover"
                        id="radio_group_default_hint-hint">help_outline</i>
                </span>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" id="customRadio1" name="radio_group_default_hint" type="radio" value="1"/>
                    <label class="custom-control-label" for="customRadio1">Radio 1</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" id="customRadio2" name="radio_group_default_hint" type="radio" value="2"/>
                    <label class="custom-control-label" for="customRadio2">Radio 2</label>
                </div>
            </div>
            <script>
                $('#radio_group_default_hint-hint').popover();
            </script>
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

        return UI::radioGroup('Radio Group', 'radio_group_default_hint', $options)
            ->hint("My hint");
    }
}
