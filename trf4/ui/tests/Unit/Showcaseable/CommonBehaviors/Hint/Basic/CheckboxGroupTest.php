<?php

namespace Tests\Unit\Showcaseable\CommonBehaviors\Hint\Basic;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class CheckboxGroupTest extends Showcaser
{

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
            <div class="form-group">
                <span class="w-100">
                    Checkbox Group
                    <i class="material-icons float-right" data-content="My hint" data-html="false" data-toggle="popover" data-trigger="hover" id="check_group_hint-hint">help_outline</i>
                </span>
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" disabled="disabled" id="check_group_hint_1" name="check_group_hint" type="checkbox" value="1" />
                    <label class="custom-control-label" for="check_group_hint_1">Checkbox 1</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input checked="checked" class="custom-control-input" id="customCheckbox2_2" name="customCheckbox2" type="checkbox" value="2" />
                    <label class="custom-control-label" for="customCheckbox2_2">Checkbox 2</label>
                </div>
            </div>
            <script>
                $('#check_group_hint-hint').popover();
            </script>
html
            ]

        ];
    }

    public function actual(): string
    {
        $options = [
            UI::checkbox('Checkbox 1', null, 1)->disabled(),
            UI::checkbox('Checkbox 2', 'customCheckbox2', 2)->checked(),
        ];

        return UI::checkboxGroup('Checkbox Group', $options, 'check_group_hint')
            ->hint('My hint');
    }
}
