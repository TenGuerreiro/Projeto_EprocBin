<?php

namespace Tests\Unit\Showcaseable\Select\Single;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class OptGroupTest extends Showcaser
{

    protected $description = <<<MD
Por padrão, as opções de um select são inseridas como chaves e valores em um array. (ver exemplos do select)<br>
Entretanto, se for parametrizado um `array`, a biblioteca o considerará como um grupo de options, ou seja, um elemento `<optgroup>`.<br><br>
Seu formato é o seguinte: <br>
* 1 - Rótulo (`string`)    
* 2 - Opções (`array`)    
* 3 - Disabled (opcional, default false, `boolean`)
MD;

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
                <div class="form-group">
                    <label class="d-block" for="select_optgroup">Select</label>
                    <select id="select_optgroup" name="select_optgroup">
                        <option value="0">Nenhum</option>
                        <optgroup label="Vegetais">
                            <option value="2">Cenoura</option>
                            <option value="3">Beterraba</option>
                        </optgroup>
                        <optgroup label="Frutas" disabled="disabled">
                            <option value="4">Tomate</option>
                            <option value="5">Banana</option>
                        </optgroup>
                    </select>
                </div>
                <script>UI.PHPHelper.select.init('select_optgroup', "");</script>
html


            ]

        ];
    }

    public function actual(): string
    {
        return UI::select('Select', 'select_optgroup', [
            0 => 'Nenhum',
            ['Vegetais', [
                2 => 'Cenoura',
                3 => 'Beterraba'
            ]],
            ['Frutas', [
                4 => 'Tomate',
                5 => 'Banana'
            ], true]
        ])->render();
    }
}
