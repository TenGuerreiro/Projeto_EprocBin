<?php

namespace Tests\Unit\Showcaseable\InputText\SettingValue;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class EmptyValueTest extends Showcaser
{

    public function actual(): string
    {
        return UI::inputText('Input Text', 'input_2')
            ->value('');
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                <div class="form-group">
                    <label for="input_2">Input Text</label>
                    <input class="form-control form-control-sm" id="input_2" name="input_2" type="text"/>
                </div>
html
            ]
        ];
    }
}

