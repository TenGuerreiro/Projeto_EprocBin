<?php

namespace Tests\Unit\Showcaseable\Range\AutoStepCalc;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class RangeTest extends Showcaser
{

    public function actual(): string
    {
        return UI::range('Range', 'range_withdecimalvalue', 0, 10)->value(7.05);
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                <div class="form-group">
                    <label for="range_withdecimalvalue">Range</label>
                    <div class="range-slider range-control d-flex">
                        <input class="custom-range" data-thumbwidth="20" id="range_withdecimalvalue" max="10" min="0" name="range_withdecimalvalue" step="0.01" type="range" value="7.05" />
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

