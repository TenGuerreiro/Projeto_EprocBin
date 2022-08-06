<?php

namespace Tests\Unit\Showcaseable\CommonBehaviors\NullLabel;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class SelectTest extends Showcaser
{

    protected $name = 'Null Label';
    protected $description = <<<md
Caso não precise de um `label`, bastar informar o primeiro parâmetro como `null`.
md;

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
            <div class="form-group">
                <select id="select_no_label" name="select_no_label">
                    <option value="1">a</option>
                    <option value="2">b</option>
                </select>
            </div>
            <script>UI.PHPHelper.select.init('select_no_label', "");</script>
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

        return UI::select(null, 'select_no_label', $options);
    }
}
