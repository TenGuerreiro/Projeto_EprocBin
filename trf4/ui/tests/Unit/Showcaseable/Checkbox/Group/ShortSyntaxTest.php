<?php

namespace Tests\Unit\Showcaseable\Checkbox\Group;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class ShortSyntaxTest extends Showcaser
{
    protected $name = 'Options - Sintaxe Curta';

    protected $description = <<<MARKDOWN
A forma simplificada de criar um conjunto de options é usando arrays.<br>
Nesse caso, a chave do array será o atributo `value` da `option` e o valor, seu html interno.
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
                <div class="form-group">
                    <span>Checkbox group</span>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" id="short_syntax_checkboxes_1" name="short_syntax_checkboxes" type="checkbox" value="1">
                        <label class="custom-control-label" for="short_syntax_checkboxes_1">Checkbox 1</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" id="short_syntax_checkboxes_2" name="short_syntax_checkboxes" type="checkbox" value="2">
                        <label class="custom-control-label" for="short_syntax_checkboxes_2">Checkbox 2</label>
                    </div>
                </div>
html
            ]
        ];
    }

    public function actual(): string
    {
        $options = [
            ['Checkbox 1', 1],
            ['Checkbox 2', 2]
        ];

        return UI::checkboxGroup('Checkbox group', $options, 'short_syntax_checkboxes');
    }
}