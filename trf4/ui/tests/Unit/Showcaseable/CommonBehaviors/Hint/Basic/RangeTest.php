<?php

namespace Tests\Unit\Showcaseable\CommonBehaviors\Hint\Basic;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class RangeTest extends Showcaser
{

    public function description(): string
    {
        return 'Cria um campo range simples com hint(tooltip)';
    }

    public function actual(): string
    {
        return UI::range('Range', 'range_hint', 0, 10)
            ->hint("My hint");
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                <div class="form-group">
                    <label class="w-100" for="range_hint">
                        Range
                        <i class="material-icons float-right"                        
                           data-content="My hint"
                           data-html="false"
                           data-toggle="popover"
                           data-trigger="hover"
                           id="range_hint-hint">help_outline</i>
                    </label>
                    <div class="range-slider range-control d-flex">
                         <input class="custom-range" data-thumbwidth="20" id="range_hint" max="10" min="0" name="range_hint" step="1" type="range" value="0">
                       <output></output>
                        <div class="progress-bar progress-bar-striped progress-bar-animated slider-selection"></div>
                        <div class="rangeValues"></div>
                    </div>
                </div>
                <script>$('#range_hint-hint').popover();</script>
html
            ]
        ];
    }
}

