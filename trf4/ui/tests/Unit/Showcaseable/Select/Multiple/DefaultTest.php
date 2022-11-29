<?php

namespace Tests\Unit\Showcaseable\Select\Multiple;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class DefaultTest extends Showcaser
{

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
            <div class="form-group">
                <label class="d-block" for="multiselect_default">Multiple Select</label>
                <select id="multiselect_default" multiple="true" name="multiselect_default[]">
                    <option value="1">a</option>
                    <option value="2">b</option>
                </select>
            </div>
            <script>UI.PHPHelper.select.init('multiselect_default', "");</script>
html
            ]

        ];
    }

    public function actual(): string
    {
        return UI::multiSelect('Multiple Select', 'multiselect_default', [1 => 'a', 2 => 'b']);
    }
}