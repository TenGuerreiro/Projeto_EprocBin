<?php

namespace Tests\Unit\Showcaseable\Select\Single;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class ADefaultTest extends Showcaser
{

    protected $name = 'Simple options';

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
            <div class="form-group">
                <label class="d-block" for="select_1">Select</label>
                <select id="select_1" name="select_1">
                    <option value="1">a</option>
                    <option value="2">b</option>
                </select>
            </div>
            <script>UI.PHPHelper.select.init('select_1', "");</script>
html
            ]
        ];
    }

    public function actual(): string
    {
        $options = [
            1 => 'a',
            2 => 'b'
        ];

        return UI::select('Select', 'select_1', $options);
    }
}
