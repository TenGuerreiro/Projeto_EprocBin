<?php

namespace Tests\Unit\Showcaseable\Alert\Types;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class InfoTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Para criar um alerta informativo, utilize o método `info()`
MARKDOWN;

    public function actual(): string
    {
        return UI::alert('Alerta')->info();
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                    <div class="alert alert-info" role="alert">
                        Alerta
                    </div>
html
            ]
        ];
    }
}

