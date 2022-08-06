<?php

namespace Tests\Unit\Showcaseable\Range\Single;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class WithValueTest extends Showcaser
{

    public function description(): string
    {
        return 'Cria um campo range simples com valor pré definido.';
    }

    public function actual(): string
    {
        return UI::range('Range', 'range_withvalue', 0, 10)->value(7);
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                <div class="form-group">
                    <label for="range_withvalue">Range</label>
                    <div class="range-slider range-control d-flex">
                        <input class="custom-range" data-thumbwidth="20" id="range_withvalue" max="10" min="0" name="range_withvalue" step="1" type="range" value="7" />
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

