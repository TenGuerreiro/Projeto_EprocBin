<?php

namespace Tests\Unit\Showcaseable\Alert\Types;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class DangerTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Para criar um alerta de perigo, utilize o método `danger()`
MARKDOWN;

    public function actual(): string
    {
        return UI::alert('Alerta')->danger();
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
            <div class="alert alert-danger" role="alert">
               Alerta
            </div>
html
            ]
        ];
    }
}

