<?php

namespace Tests\Unit\Showcaseable\Select\Single\ActivatedBy;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class ActivatedByTest extends Showcaser
{

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<HTML
<div class="custom-control custom-checkbox form-group">
    <input class="custom-control-input" id="select_activator" name="select_activator" type="checkbox"> <label class="custom-control-label" for="select_activator">Activate Select</label>
</div>
<div class="form-group">
    <label class="d-block" for="activated-by-chk-select">My Select</label>
    
    <select id="activated-by-chk-select" name="activated-by-chk-select">
        <option value="1">a</option>
        <option value="2">b</option>
    </select>
</div>

<script>
    UI.PHPHelper.addActivatedBy('activated-by-chk-select', 'select_activator');UI.PHPHelper.select.init('activated-by-chk-select', "");
</script>
HTML
            ]

        ];
    }

    public function actual(): string
    {

        return
            UI::checkbox('Activate Select', 'select_activator')
            .
            UI::select('My Select', 'activated-by-chk-select', [1 => 'a', 2 => 'b'])
                ->activatedBy('select_activator');
    }
}
