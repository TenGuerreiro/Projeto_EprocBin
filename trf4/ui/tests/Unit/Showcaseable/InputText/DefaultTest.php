<?php

namespace Tests\Unit\Showcaseable\InputText;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class DefaultTest extends Showcaser
{
    
    protected $componentMethod = "inputText";

    public function actual(): string
    {
        return UI::inputText('Input Text', 'input_text');
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                <div class="form-group">
                    <label for="input_text">Input Text</label>
                    <input class="form-control form-control-sm" id="input_text" name="input_text" type="text"/>
                </div>
html
            ]
        ];
    }
}

