<?php

namespace Tests\Unit\Showcaseable\Textarea\WithValue;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class WithValueTest extends Showcaser
{


    public function actual(): string
    {
        return UI::textarea('Textarea', 'textarea_1')
            ->value('My text');
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                <div class="form-group">
                    <label for="textarea_1">Textarea</label>
                    <textarea class="form-control form-group" id="textarea_1" name="textarea_1">My text</textarea>
                </div>
html
            ]
        ];
    }
}

