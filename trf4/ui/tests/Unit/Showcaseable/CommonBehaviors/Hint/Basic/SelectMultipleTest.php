<?php

namespace Tests\Unit\Showcaseable\CommonBehaviors\Hint\Basic;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class SelectMultipleTest extends Showcaser
{

    protected $description = "Campo de seleção múltipla com hint(tooltip).";

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
                <div class="form-group">
                    <label class="d-block w-100" for="multiselect_hint">
                        Multiple Select
                        <i class="material-icons float-right" data-content="My hint" data-html="false" data-toggle="popover" data-trigger="hover" id="multiselect_hint-hint">help_outline</i>
                    </label>
                    <select id="multiselect_hint" multiple="true" name="multiselect_hint[]">
                        <option value="1">a</option>
                        <option value="2">b</option>
                    </select>
                </div>
                <script>$('#multiselect_hint-hint').popover();UI.PHPHelper.select.init('multiselect_hint', "");</script>
html
            ]

        ];
    }

    public function actual(): string
    {
        return UI::multiSelect('Multiple Select', 'multiselect_hint', [1 => 'a', 2 => 'b'])
            ->hint("My hint");
    }
}