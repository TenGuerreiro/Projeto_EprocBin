<?php

namespace Tests\Unit\Showcaseable\CommonBehaviors\AccessKey\Basic;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class InputTextTest extends Showcaser
{

    public function actual(): string
    {
        return UI::inputText('Abc Abc', 'input_text_access_key')->accesskey('a');
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                <div class="form-group">
                    <label for="input_text_access_key">
                        <u>A</u>bc Abc
                    </label>
                    <input accesskey="a" class="form-control form-control-sm" id="input_text_access_key" name="input_text_access_key" type="text" />
                </div>
html
            ]
        ];
    }
}

