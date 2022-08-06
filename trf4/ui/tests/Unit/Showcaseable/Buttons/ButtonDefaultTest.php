<?php

namespace Tests\Unit\Showcaseable\Buttons;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class ButtonDefaultTest extends Showcaser
{
    
    protected $componentMethod = "button";

    public function actual(): string
    {
        return UI::button('Botão secundário (default)');
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
             <button
                class="btn btn-sm btn-secondary"
                >Botão secundário (default)</button>
html
            ]
        ];
    }
}

