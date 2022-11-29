<?php

namespace Tests\Unit\Showcaseable\Checkbox\Single;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class IdPrevailsOverNameTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Por padrão, a `id` é idêntica ao `name`. Para alterá-la, basta chamar o método `id()`
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
 				<div class="custom-control custom-checkbox form-group">
                    <input class="custom-control-input" id="checkbox_id" name="checkbox_name" type="checkbox"/>
                    <label class="custom-control-label" for="checkbox_id">Checkbox</label>
                </div>
html
            ]

        ];
    }

    public function actual(): string 
    {
        return UI::checkbox('Checkbox', 'checkbox_name')->id('checkbox_id');
    }

}
