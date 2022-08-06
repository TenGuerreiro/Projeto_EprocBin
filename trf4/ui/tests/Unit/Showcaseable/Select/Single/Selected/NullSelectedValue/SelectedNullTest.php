<?php

namespace Tests\Unit\Showcaseable\Select\Single\Selected\NullSelectedValue;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class SelectedNullTest extends Showcaser
{

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
            <div class="form-group">
                <label class="d-block" for="select_selected_2">Select</label>
                <select id="select_selected_2" name="select_selected_2">
                    <option value="">Select a value...</option>
                    <option value="1">a</option>
                    <option value="2">b</option>
                </select>
            </div>
            <script>UI.PHPHelper.select.init('select_selected_2', "");</script>
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

        return UI::select('Select', 'select_selected_2', $values)
            ->placeholder('Select a value...')
            ->selected(null);
    }
}
