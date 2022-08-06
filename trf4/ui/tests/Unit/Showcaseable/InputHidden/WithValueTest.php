<?php

namespace Tests\Unit\Showcaseable\InputHidden;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class WithValueTest extends Showcaser
{
    
    protected $description = <<<MARKDOWN
Cria um campo input hidden com valor(value).
MARKDOWN;

    public function actual(): string
    {
        return UI::hidden('hidden_input_w_value', 'my_value');
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                <input id="hidden_input_w_value" name="hidden_input_w_value" type="hidden" value="my_value">
html
            ]
        ];
    }
}

