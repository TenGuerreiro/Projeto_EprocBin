<?php

namespace Tests\Unit\Showcaseable\Checkbox\Single;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class CheckedTest extends Showcaser
{
    
    protected $description = <<<MARKDOWN
Cria um campo checkbox com atributo checked. <br>
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
 				<div class="custom-control custom-checkbox form-group">
 					<input checked="checked" class="custom-control-input" id="checked_checkbox" name="checked_checkbox" type="checkbox" />
					<label class="custom-control-label" for="checked_checkbox">Checkbox</label>
				</div>
html
            ]

        ];
    }

    public function actual(): string 
    {
        return UI::checkbox('Checkbox', 'checked_checkbox')->checked();
    }

}
