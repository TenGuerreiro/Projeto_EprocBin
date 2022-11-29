<?php

namespace Tests\Unit\Showcaseable\Alert\Types;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class SecondaryTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Para criar um alerta secundário, utilize o método `secondary()`.
MARKDOWN;

    public function actual(): string
    {
        return UI::alert('Alerta')->secondary();
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
            <div class="alert alert-secondary" role="alert">
                Alerta
            </div>
html
            ]
        ];
    }
}

