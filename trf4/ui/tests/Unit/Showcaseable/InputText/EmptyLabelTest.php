<?php

namespace Tests\Unit\Showcaseable\InputText;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class EmptyLabelTest extends Showcaser
{
    
    protected $description = <<<MARKDOWN
É possível criar um InputText sem rótulo se o primeiro parâmetro for nulo.
MARKDOWN;

    public function actual(): string
    {
        return UI::inputText(null, 'input_1_no_label');
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                <div class="form-group">
                    <input class="form-control form-control-sm" id="input_1_no_label" name="input_1_no_label" type="text"/>
                </div>
html
            ]
        ];
    }
}

