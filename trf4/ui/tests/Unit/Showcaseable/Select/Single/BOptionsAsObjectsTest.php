<?php

namespace Tests\Unit\Showcaseable\Select\Single;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class BOptionsAsObjectsTest extends Showcaser
{

    protected $name = 'Options as Objects';
    protected $description = <<<MD
Para maiores possibilidades de customização, 
é possível adicionar opções como objetos do tipo `Option` ao invés de arrays.
Para isso, utilize <code>UI::option(\$value, \$innerHtml)</code>
MD;

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
            <div class="form-group">
                <label class="d-block" for="select_2">Select</label>
                <select id="select_2" name="select_2">
                    <option value="1" data-what="ever">a</option>
                    <option value="2">b</option>
                </select>
            </div>
            <script>UI.PHPHelper.select.init('select_2', "");</script>
html
            ]

        ];
    }

    public function actual(): string
    {
        $options = [
            UI::option(1, 'a')->dataWhat('ever'),
            UI::option(2, 'b'),
        ];

        return UI::select('Select', 'select_2', $options);
    }
}
