<?php

namespace Tests\Unit\Showcaseable\Range\Multiple;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class NoLabelTest extends Showcaser
{
    
    protected $name = "Nullable label";
    protected $description = <<<MARKDOWN
Componente de range múltiplo sem label.
MARKDOWN;

    public function actual(): string
    {
        return UI::multiRange(null, 'range_multi_no_label', 10, 200);
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                <div class="form-group">
                    <div class="range-slider multi-range range-control d-flex">
                        <input class="custom-range" data-thumbwidth="20" id="range_multi_no_label" max="200" min="10" name="range_multi_no_label" step="1" type="range" value="10" />
                       <output></output>
                        <input class="custom-range" data-thumbwidth="20" id="range_multi_no_label_2" max="200" min="10" name="range_multi_no_label_2" step="1" type="range" value="200" />
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

