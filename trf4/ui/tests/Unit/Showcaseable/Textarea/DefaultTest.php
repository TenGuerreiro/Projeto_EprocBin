<?php

namespace Tests\Unit\Showcaseable\Textarea;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class DefaultTest extends Showcaser
{

    public function actual(): string
    {
        return UI::textarea('Textarea', 'default_textarea');
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                <div class="form-group">
                    <label for="default_textarea">Textarea</label>
                    <textarea class="form-control form-group" id="default_textarea" name="default_textarea"></textarea>
                </div>
html
            ]
        ];
    }
}

