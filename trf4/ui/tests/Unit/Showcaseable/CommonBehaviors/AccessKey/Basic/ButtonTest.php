<?php

namespace Tests\Unit\Showcaseable\CommonBehaviors\AccessKey\Basic;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class ButtonTest extends Showcaser
{
    
    public function actual(): string
    {
        return UI::button('Abc Def')->accesskey('d');
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                <button accesskey="d" class="btn btn-sm btn-secondary">
                    Abc&nbsp;
                    <u>D</u>ef
                </button>
html
            ]
        ];
    }
}