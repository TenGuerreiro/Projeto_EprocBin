<?php

namespace Tests\Unit\Showcaseable\CommonBehaviors\NullLabel;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class SelectMultipleTest extends Showcaser
{
    protected $name = "Nullable label";
    protected $description = "Campo de seleção múltipla sem label";

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
            <div class="form-group">
                <select id="multiselect_default_no_label" multiple="true" name="multiselect_default_no_label[]">
                    <option value="1">a</option>
                    <option value="2">b</option>
                </select>
            </div>
            <script>UI.PHPHelper.select.init('multiselect_default_no_label', "");</script>
html
            ]

        ];
    }

    public function actual(): string
    {
        return UI::multiSelect(null, 'multiselect_default_no_label', [1 => 'a', 2 => 'b']);
    }
}