<?php

namespace Tests\Unit\Showcaseable\InputText;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class XSSTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Por padrão, o valor de entrada do método `value` é limpado para evitar ataques de XSS.

Caso queira desabilitar esse comportamento, utilize o método `noValueSanitizing()` 
MARKDOWN;
    protected $name = "XSS (Cross-site scripting) prevention";

    public function actual(): string
    {
        return UI::inputText('Input Text XSS', 'input_text_xss')
            ->value('"<script>alert("prevent XSS");</script>');
    }

    public function rendererExpectations(): array
    {
        return [
            [

                new BS4Renderer, <<<html
                <div class="form-group">
                    <label for="input_text_xss">Input Text XSS</label>
                    <input class="form-control form-control-sm" id="input_text_xss" name="input_text_xss" type="text" value="&amp;quot;&amp;lt;script&amp;gt;alert(&amp;quot;prevent XSS&amp;quot;);&amp;lt;/script&amp;gt;"/>
                </div>
html
            ]
        ];
    }
}

