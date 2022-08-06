<?php

namespace Tests\Unit\Showcaseable\Select\Single\ActivatedBy;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class ActivatedBySelectTest extends Showcaser
{

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<HTML
<div class="form-group">
    <label class="d-block" for="select_activator_2">Activate Select</label>
    <select id="select_activator_2" name="select_activator_2">
        <option value="">Select...</option>
        <option value="1">1</option>
        <option value="2">2</option>
    </select>
</div>
<script>UI.PHPHelper.select.init('select_activator_2', "");</script>
<div class="form-group">
    <label class="d-block" for="activated-by-select">My Select</label>
    <select id="activated-by-select" name="activated-by-select">
        <option value="1">a</option>
        <option value="2">b</option>
    </select>
</div>
<script>UI.PHPHelper.addActivatedBy('activated-by-select', 'select_activator_2');UI.PHPHelper.select.init('activated-by-select', "");</script>
HTML
            ]

        ];
    }

    public function actual(): string
    {

        return
            UI::select('Activate Select', 'select_activator_2', [1 => '1', 2 => '2'])->placeholder('Select...')
            .
            UI::select('My Select', 'activated-by-select', [1 => 'a', 2 => 'b'])
                ->activatedBy('select_activator_2');
    }
}
