<?php

namespace Tests\Unit\Showcaseable\CommonBehaviors\NullLabel;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class InputNumberTest extends Showcaser
{
    
    protected $name = 'Nullable label';
    protected $description = <<<MARKDOWN
Input de tipo `number`.
MARKDOWN;

    public function actual(): string
    {
        return UI::inputNumber(null, 'my_input_number_no_label')->max(10)->min(2)->step(0.5);
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
            <div class="form-group">
                <input class="form-control form-control-sm" id="my_input_number_no_label" max="10" min="2" name="my_input_number_no_label" step="0.5" type="number" />
            </div>
html
            ]
        ];
    }
}

