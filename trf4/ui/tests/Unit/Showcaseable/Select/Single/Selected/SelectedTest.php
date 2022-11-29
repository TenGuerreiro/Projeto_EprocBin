<?php

namespace Tests\Unit\Showcaseable\Select\Single\Selected;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class SelectedTest extends Showcaser
{

    protected $description = "Utilizando o método `selected`, é possível deixar uma opção selecionada com base em seu `value`.";

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
            <div class="form-group">
                <label class="d-block" for="select_selected">Select</label>
                <select id="select_selected" name="select_selected">
                    <option value="">Select a value...</option>
                    <option value="1" selected="selected">a</option>
                    <option value="2">b</option>
                </select>
            </div>
            <script>UI.PHPHelper.select.init('select_selected', "");</script>
html
            ]

        ];
    }

    public function actual(): string
    {
        $values = [
            1 => 'a',
            2 => 'b'
        ];

        return UI::select('Select', 'select_selected', $values)
            ->placeholder('Select a value...')
            ->selected(1);
    }
}
