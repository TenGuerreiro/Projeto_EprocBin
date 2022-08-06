<?php

namespace Tests\Unit\Showcaseable\Alert\Types;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class SuccessTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Para criar um alerta de sucesso, utilize o método `success()`
MARKDOWN;

    public function actual(): string
    {
        return UI::alert('Alerta')->success();
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
            <div class="alert alert-success" role="alert">
                Alerta
            </div>
html
            ]
        ];
    }

}

