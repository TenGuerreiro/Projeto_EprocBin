<?php

namespace Tests\Unit\Showcaseable\Checkbox\Single;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class CheckedFalseTest extends Showcaser
{
    
    protected $description = <<<MARKDOWN
Se o parâmetro booleano `checked` do método `checked` for falso, o campo não será marcado.
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
 				<div class="custom-control custom-checkbox form-group">
 					<input class="custom-control-input" id="not_chk_checkbox" name="not_chk_checkbox" type="checkbox" />
					<label class="custom-control-label" for="not_chk_checkbox">Checkbox</label>
				</div>
html
            ]

        ];
    }

    public function actual(): string 
    {
        return UI::checkbox('Checkbox', 'not_chk_checkbox')->checked(false);
    }

}
