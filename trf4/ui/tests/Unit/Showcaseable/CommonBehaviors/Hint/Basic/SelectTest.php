<?php

namespace Tests\Unit\Showcaseable\CommonBehaviors\Hint\Basic;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class SelectTest extends Showcaser
{

    protected $description = "Cria um campo select com hint(tooltip)";

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
            <div class="form-group">
                <label class="d-block w-100" for="select_default_hint">
                    Select
                    <i class="material-icons float-right"                        
                        data-content="My hint"
                        data-html="false"
                        data-toggle="popover"
                        data-trigger="hover"
                        id="select_default_hint-hint">help_outline</i>
                </label>
                <select id="select_default_hint" name="select_default_hint">
                    <option value="1">a</option>
                    <option value="2">b</option>
                </select>
            </div>
            <script>$('#select_default_hint-hint').popover();UI.PHPHelper.select.init('select_default_hint', "");</script>
html
            ]

        ];
    }

    public function actual(): string
    {
        return UI::select('Select', 'select_default_hint', [1 => 'a', 2 => 'b'])
            ->hint("My hint");
    }
}
