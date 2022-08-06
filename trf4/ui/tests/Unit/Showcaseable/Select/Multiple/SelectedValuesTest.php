<?php

namespace Tests\Unit\Showcaseable\Select\Multiple;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class SelectedValuesTest extends Showcaser
{

    protected $description = "
Cria um campo Multi Select com valores pré-selecionados.
Utilizando o método `selected`, é possível deixar uma opção selecionada com base em seu `value`.";

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
            <div class="form-group">
                <label class="d-block" for="multiselect_default_values">Multiple Select</label>
                <select id="multiselect_default_values" multiple="true" name="multiselect_default_values[]">
                    <option selected="selected" value="1">a</option>
                    <option selected="selected" value="2">b</option>
                </select>
            </div>
            <script>UI.PHPHelper.select.init('multiselect_default_values', "");</script>
html
            ]

        ];
    }

    public function actual(): string
    {
        return UI::multiSelect('Multiple Select', 'multiselect_default_values', [1 => 'a', 2 => 'b'])->selected([1, 2]);
    }
}   