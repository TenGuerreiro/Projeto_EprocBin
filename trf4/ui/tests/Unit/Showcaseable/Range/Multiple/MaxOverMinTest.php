<?php

namespace Tests\Unit\Showcaseable\Range\Multiple;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class MaxOverMinTest extends Showcaser
{

    protected $description = "Não é obrigatório que os valores mínimo e máximo sejam parametrizados exatamente nessa ordem, ou seja: caso estejam invertidos, o componente irá ordená-los corretamente.";

    public function actual(): string
    {
        return UI::multiRange('Multi Range', 'range_multi_maxovermin', 200, 10);
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                <div class="form-group">
                    <label for="range_multi_maxovermin">Multi Range</label>
                    <div class="range-slider multi-range range-control d-flex">
                        <input class="custom-range" data-thumbwidth="20" id="range_multi_maxovermin" max="200" min="10" name="range_multi_maxovermin" step="1" type="range" value="10" />
                       <output></output>
                        <input class="custom-range" data-thumbwidth="20" id="range_multi_maxovermin_2" max="200" min="10" name="range_multi_maxovermin_2" step="1" type="range" value="200" />
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

