<?php

namespace Tests\Unit\Showcaseable\Select\Single;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class RequiredTest extends Showcaser
{

    protected $description = "Cria um campo select de preenchimento obrigatório";

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
            <div class="form-group">
                <label class="d-block" for="select_required">Select<span class="text-danger">*</span></label>
                <select id="select_required" name="select_required" required>
                    <option value="1">a</option>
                    <option value="2">b</option>
                </select>
            </div>
            <script>UI.PHPHelper.select.init('select_required', "<div class='invalid-feedback'>O campo \"Select\" \u00e9 obrigat\u00f3rio<\/div>");</script>
html
            ]

        ];
    }

    public function actual(): string
    {
        return UI::select('Select', 'select_required', [1 => 'a', 2 => 'b'])->required();
    }
}
