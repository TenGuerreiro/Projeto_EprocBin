<?php

namespace Tests\Unit\Showcaseable\CommonBehaviors\AccessKey\NoMatches;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class InputTextNoCharTest extends Showcaser
{

    public function actual(): string
    {
        return UI::inputText('abc def', 'input_text_access_key_no_char')->accesskey('g');
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                <div class="form-group">
                    <label for="input_text_access_key_no_char">
                        abc def
                    </label>
                    <input accesskey="g" class="form-control form-control-sm" id="input_text_access_key_no_char" name="input_text_access_key_no_char" type="text" />
                </div>
html
            ]
        ];
    }
}