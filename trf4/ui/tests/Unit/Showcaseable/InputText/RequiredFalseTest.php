<?php

namespace Tests\Unit\Showcaseable\InputText;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class RequiredFalseTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Caso o segundo parâmetro, `required`, seja definido como false, a condição de required não será aplicada ao componente.
MARKDOWN;

    public function actual(): string
    {
        return UI::inputText('Input Text', 'required_false_input_text')->required(null, false);
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer(), <<<html
                <div class="form-group">
                    <label for="required_false_input_text">Input Text</label>
                    <input class="form-control form-control-sm" id="required_false_input_text" name="required_false_input_text" type="text"/>
                </div>
html
            ]
        ];
    }
}

