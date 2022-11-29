<?php

namespace Tests\Unit\Showcaseable\Buttons;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class InputButtonPrimaryTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Todos os métodos do `Button` são acessíveis pelo `inputButton`. Por exemplo, é possível deixá-lo como primário utilizando o método `primary()`
MARKDOWN;

    public function actual(): string
    {
        return UI::inputButton('Botão')->primary();
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                <input class="btn btn-sm btn-primary" type="button" value="Botão" />
html
            ]
        ];
    }
}

