<?php

namespace Tests\Unit\Showcaseable\InputText\SettingValue;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class NullValueTest extends Showcaser
{

    public function actual(): string
    {
        return UI::inputText('Input Text', 'input_1')
            ->value(null);
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                <div class="form-group">
                    <label for="input_1">Input Text</label>
                    <input class="form-control form-control-sm" id="input_1" name="input_1" type="text"/>
                </div>
html
            ]
        ];
    }
}

