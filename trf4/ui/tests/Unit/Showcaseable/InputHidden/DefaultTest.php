<?php

namespace Tests\Unit\Showcaseable\InputHidden;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class DefaultTest extends Showcaser
{
    
    protected $componentMethod = "hidden";

    public function actual(): string
    {
        return UI::hidden('hidden_input');
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                <input id="hidden_input" name="hidden_input" type="hidden">
html
            ]
        ];
    }
}

