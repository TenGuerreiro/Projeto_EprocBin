<?php

namespace Tests\Unit\Showcaseable\Buttons;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class InputButtonDefaultTest extends Showcaser
{
    
    protected $componentMethod = "inputButton";

    public function actual(): string
    {
        return UI::inputButton('Botão');
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                <input class="btn btn-sm btn-secondary" type="button" value="Botão" />
html
            ]
        ];
    }
}

