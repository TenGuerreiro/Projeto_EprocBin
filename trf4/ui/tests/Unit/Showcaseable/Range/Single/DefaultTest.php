<?php

namespace Tests\Unit\Showcaseable\Range\Single;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class DefaultTest extends Showcaser
{

    public function actual(): string
    {
        return UI::range('Range', 'range', 0, 10);
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                <div class="form-group">
                    <label for="range">Range</label>
                    <div class="range-slider range-control d-flex">
                         <input class="custom-range" data-thumbwidth="20" id="range" max="10" min="0" name="range" step="1" type="range" value="0">
                         <output></output>
                        <div class="progress-bar progress-bar-striped progress-bar-animated slider-selection"></div>
                        <div class="rangeValues"></div>
                    </div>
                </div>
html
            ]
        ];
    }
}

