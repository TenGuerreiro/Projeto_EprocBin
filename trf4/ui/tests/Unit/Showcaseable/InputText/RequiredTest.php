<?php

namespace Tests\Unit\Showcaseable\InputText;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class RequiredTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Cria um campo input text com preenchimento obrigatório.
MARKDOWN;

    public function actual(): string
    {
        return UI::inputText('Input Text', 'required_input_text')->required();
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer(), <<<html
                <div class="form-group">
                    <label for="required_input_text">Input Text<span class="text-danger">*</span></label>
                    <input class="form-control form-control-sm" id="required_input_text" name="required_input_text" required type="text"/>
                    <div class='invalid-feedback'>O campo "Input Text" é obrigatório</div>
                </div>
html
            ]
        ];
    }
}

