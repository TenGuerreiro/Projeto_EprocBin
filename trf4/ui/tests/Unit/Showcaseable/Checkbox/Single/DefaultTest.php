<?php

namespace Tests\Unit\Showcaseable\Checkbox\Single;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class DefaultTest extends Showcaser
{

    protected $componentMethod = "checkbox";

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
                <div class="custom-control custom-checkbox form-group">
                    <input class="custom-control-input" id="default_check" name="default_check" type="checkbox" />
                    <label class="custom-control-label" for="default_check">Checkbox</label>
                </div>
html
            ]

        ];
    }

    public function actual(): string
    {
        return UI::checkbox('Checkbox', 'default_check');
    }
}
