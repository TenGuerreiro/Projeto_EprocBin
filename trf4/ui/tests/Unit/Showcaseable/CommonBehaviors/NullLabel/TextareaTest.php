<?php

namespace Tests\Unit\Showcaseable\CommonBehaviors\NullLabel;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class TextareaTest extends Showcaser
{
    protected $name = "Nullable label";
    protected $description = <<<MARKDOWN
Cria um campo text area sem label
MARKDOWN;

    public function actual(): string
    {
        return UI::textarea(null, 'no_label_textarea');
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                <div class="form-group">
                    <textarea class="form-control form-group" id="no_label_textarea" name="no_label_textarea"></textarea>
                </div>
html
            ]
        ];
    }
}

