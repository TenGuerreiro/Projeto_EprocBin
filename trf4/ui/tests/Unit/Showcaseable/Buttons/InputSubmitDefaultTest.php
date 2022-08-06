<?php

namespace Tests\Unit\Showcaseable\Buttons;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class InputSubmitDefaultTest extends Showcaser
{
    
    protected $componentMethod = "inputSubmit"; 

    public function actual(): string
    {
        return UI::inputSubmit('Enviar');
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                <input class="btn btn-sm btn-primary" type="submit" value="Enviar" />
html
            ]
        ];
    }
}

