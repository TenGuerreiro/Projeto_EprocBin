<?php

namespace Tests\Unit\Showcaseable\Buttons;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class ButtonPrimaryTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Para criar um botão primário, utilize o método `primary()`.
MARKDOWN;

    public function actual(): string
    {
        return UI::button('Botão primário')->primary();
    }

    public function rendererExpectations(): array
    {
        return [
            [new BS4Renderer, '<button class="btn btn-sm btn-primary">Botão primário</button>'],
        ];
    }
}