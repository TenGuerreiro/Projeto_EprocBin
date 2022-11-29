<?php

namespace Tests\Unit\Showcaseable\Alert\Types;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class ADefaultTest extends Showcaser
{

    protected $componentMethod = 'alert';

    public function actual(): string
    {
        return UI::alert("Alerta");
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<h
            <div class="alert alert-secondary" role="alert">
                Alerta
            </div>
h

            ]

        ];
    }
}

