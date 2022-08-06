<?php

namespace Tests\Unit\Showcaseable\Checkbox\Single;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class LabelAndNameAltTest extends Showcaser
{
    protected $name = 'Alternative name syntax';
    protected $description = <<<MARKDOWN
É possível também definir o atributo `name` utilizando o método de mesmo nome.

Assim como nos demais casos, caso a `id` não seja explicitamente definida, ela terá como valor o do próprio `name`
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
 				<div class="custom-control custom-checkbox form-group">
                    <input class="custom-control-input" id="checkbox_3" name="checkbox_3" type="checkbox" />
                    <label class="custom-control-label" for="checkbox_3">Checkbox</label>
                </div>
html
            ]

        ];
    }

    public function actual(): string
    {
        return UI::checkbox('Checkbox')->name('checkbox_3');
    }

}
