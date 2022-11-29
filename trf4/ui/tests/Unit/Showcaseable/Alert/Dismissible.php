<?php

namespace Tests\Unit\Showcaseable\Alert;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class Dismissible extends Showcaser
{


    protected $description = <<<MARKDOWN
Para permitir que um alerta seja fechado, utilize o método `dismissible()`.
MARKDOWN;

    public function actual(): string
    {
        return UI::alert('Alerta')->dismissible();
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<h
            <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                Alerta
                <button aria-label="Close" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
h
            ]
        ];
    }
}

