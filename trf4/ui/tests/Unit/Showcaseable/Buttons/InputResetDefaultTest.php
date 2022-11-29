<?php

namespace Tests\Unit\Showcaseable\Buttons;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class InputResetDefaultTest extends Showcaser
{
    
    protected $componentMethod = "inputReset";

    public function actual(): string
    {
        return UI::inputReset('Limpar');
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                <input class="btn btn-sm btn-secondary" type="reset" value="Limpar">
html
            ]
        ];
    }
}

