<?php

namespace Tests\Unit\Showcaseable\Range\AutoStepCalc;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class MultiRangeTest extends Showcaser
{
    public function actual(): string
    {
        return UI::multiRange('Multi Range', 'range_multi_stepdecimal', 10, 200)->values(21.7, 50);
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                <div class="form-group">
                    <label for="range_multi_stepdecimal">Multi Range</label>
                    <div class="range-slider multi-range range-control d-flex">
                        <input class="custom-range" data-thumbwidth="20" id="range_multi_stepdecimal" max="200" min="10" name="range_multi_stepdecimal" step="0.1" type="range" value="21.7" />
                       <output></output>
                        <input class="custom-range" data-thumbwidth="20" id="range_multi_stepdecimal_2" max="200" min="10" name="range_multi_stepdecimal_2" step="0.1" type="range" value="50" />
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

