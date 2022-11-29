<?php

namespace Tests\Unit\Showcaseable\Range\Multiple;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class DefaultTest extends Showcaser
{
    public function actual(): string
    {
        return UI::multiRange('Range', 'range_multi', 10, 200);
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                <div class="form-group">
                    <label for="range_multi">Range</label>
                    <div class="range-slider multi-range range-control d-flex">
                        <input class="custom-range" data-thumbwidth="20" id="range_multi" max="200" min="10" name="range_multi" step="1" type="range" value="10" />
                       <output></output>
                        <input class="custom-range" data-thumbwidth="20" id="range_multi_2" max="200" min="10" name="range_multi_2" step="1" type="range" value="200" />
                       <output></output>
                        <div class="progress-bar progress-bar-striped progress-bar-animated multi-slider-selection"></div>
                        <div class="rangeValues"></div>
                    </div>
                </div>
html
            ]
        ];
    }
}

