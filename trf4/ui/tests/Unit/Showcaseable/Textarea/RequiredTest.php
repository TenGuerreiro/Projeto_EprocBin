<?php

namespace Tests\Unit\Showcaseable\Textarea;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class RequiredTest extends Showcaser
{

    protected $description = "Cria um campo text area com preenchimento obrigatório.";

    public function actual(): string
    {
        return UI::textarea('Textarea', 'required_textarea')->required();
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                <div class="form-group">
                    <label for="required_textarea">Textarea<span class="text-danger">*</span></label>
                    <textarea class="form-control form-group" id="required_textarea" name="required_textarea" required></textarea>
                    <div class='invalid-feedback'>O campo "Textarea" é obrigatório</div>
                </div>
html
            ]
        ];
    }
}

