<?php

namespace Tests\Unit\Showcaseable\CommonBehaviors\AccessKey\Basic;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class InputText2Test extends Showcaser
{

    public function actual(): string
    {
        return UI::inputText('Abc Cde', 'my_input_5')->accesskey('c');
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                <div class="form-group">
                    <label for="my_input_5">
                        Abc&nbsp;<u>C</u>de
                    </label>
                    <input accesskey="c" class="form-control form-control-sm" id="my_input_5" name="my_input_5" type="text" />
                </div>
html
            ]
        ];
    }
}

