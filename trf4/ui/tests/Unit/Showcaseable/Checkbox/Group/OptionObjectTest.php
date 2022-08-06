<?php

namespace Tests\Unit\Showcaseable\Checkbox\Group;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class OptionObjectTest extends Showcaser
{

    protected $name = "Options - Objetos";
    public function rendererExpectations(): array {
        return [
            [
                new Bootstrap4(), <<<HTML
                <div class="form-group">
                    <span>Checkbox Group</span>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" disabled="disabled" id="check_group_1" name="check_group" type="checkbox" value="1"/>
                        <label class="custom-control-label" for="check_group_1">Checkbox 1</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input checked="checked" class="custom-control-input" id="customCheckbox2_2" name="customCheckbox2" type="checkbox" value="2"/> 
                        <label class="custom-control-label" for="customCheckbox2_2">Checkbox 2</label>
                    </div>
                </div>
HTML
            ]
        ];
    }

    public function actual(): string {
        $options = [
            UI::checkbox('Checkbox 1', null, 1)->disabled(),
            UI::checkbox('Checkbox 2', 'customCheckbox2', 2)->checked(),
        ];

        return UI::checkboxGroup('Checkbox Group', $options, 'check_group');
    }
}
