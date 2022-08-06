<?php

namespace Tests\Unit\Showcaseable\Textarea\WithValue;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class WithValue2Test extends Showcaser
{

    public function actual(): string
    {
        return UI::textarea('Textarea', 'textarea_2')
            ->innerHTML('My text');
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                       <div class="form-group">
                           <label for="textarea_2">Textarea</label>
                           <textarea class="form-control form-group" id="textarea_2" name="textarea_2">My text</textarea>
                       </div>
html
            ]
        ];
    }
}

