<?php

namespace Tests\Unit\Showcaseable\Checkbox\Group;

use Tests\Showcaser;
use TRF4\UI\Labeled\Checkbox;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class InlineTest extends Showcaser
{

    protected $name = "Options - Inline";

    protected $description = "Cria um grupo de opções checkbox com opções alinhada horizontalmente `inline()`";


    public function rendererExpectations(): array {
        return [
            [
                new Bootstrap4(), <<<HTML
                <div class="form-group">
                    <span class="form-check form-check-inline pl-0">Checkbox Group Inline</span>
                    <div class="custom-control custom-checkbox custom-control-inline">
                        <input class="custom-control-input" disabled="disabled" id="check_group_inline_1" name="check_group_inline" type="checkbox" value="1"/>
                        <label class="custom-control-label" for="check_group_inline_1">Checkbox 1</label>
                    </div>
                    <div class="custom-control custom-checkbox custom-control-inline">
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

        return UI::checkboxGroup('Checkbox Group Inline', $options, 'check_group_inline')->inline();
    }
}
