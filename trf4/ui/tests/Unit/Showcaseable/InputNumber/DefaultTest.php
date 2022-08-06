<?php

namespace Tests\Unit\Showcaseable\InputNumber;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class DefaultTest extends Showcaser
{
    
    protected $componentMethod = "inputNumber";

    public function actual(): string
    {
        return UI::inputNumber('Input Number', 'my_input_number')->max(10)->min(2)->step(0.5);
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
            <div class="form-group"><label for="my_input_number">Input Number</label> <input class="form-control form-control-sm" id="my_input_number" max="10" min="2" name="my_input_number" step="0.5" type="number" /> </div>
html
            ]
        ];
    }
}

