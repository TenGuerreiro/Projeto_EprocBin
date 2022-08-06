<?php

namespace Tests\Unit\Showcaseable\InputText\SettingValue;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class WithValueTest extends Showcaser
{

    public function actual(): string
    {
        return UI::inputText('Input Text', 'input_3')
            ->value('Something');
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                <div class="form-group">
                    <label for="input_3">Input Text</label>
                    <input class="form-control form-control-sm" id="input_3" name="input_3" type="text" value="Something"/>
                </div>
html
            ]
        ];
    }
}

