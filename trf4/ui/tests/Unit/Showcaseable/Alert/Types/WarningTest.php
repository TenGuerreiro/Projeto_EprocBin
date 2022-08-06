<?php

namespace Tests\Unit\Showcaseable\Alert\Types;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class WarningTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Para criar um alerta de aviso, utilize o método `warning()`
MARKDOWN;

    public function actual(): string
    {
        return UI::alert('Alerta')->warning();
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
            <div class="alert alert-warning" role="alert">
                Alerta
            </div>
html
            ]
        ];
    }
}