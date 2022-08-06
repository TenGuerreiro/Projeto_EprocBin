<?php

namespace Tests\Unit\Showcaseable\CommonBehaviors\Hint\Basic;


use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class AsHtmlTest extends Showcaser
{

    protected $name = "Hint as HTML";
    protected $description = <<<MARKDOWN
Caso o segundo parâmetro do método `hint()` seja `true`, a dica será exibida como HTML.

> Note que o valor padrão é `false` para prevenir ataques de XSS. Tendo isso em mente, tome cuidado ao parametrizar um conteúdo proveniente de entrada do usuário.   
MARKDOWN;

    public function actual(): string
    {
        return UI::inputText('Input Text', 'input_text_w_tooltip')
            ->hint('Mensagem do <b>hint</b> que usa html', true);
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer(), <<<html
               <div class="form-group">
                    <label class="w-100" for="input_text_w_tooltip">
                        Input Text
                        <i class="material-icons float-right"                        
                           data-content="Mensagem do <b>hint</b> que usa html"
                           data-html="true"
                           data-toggle="popover"
                           data-trigger="hover"
                           id="input_text_w_tooltip-hint">help_outline</i>
                    </label>
                    <input class="form-control form-control-sm" id="input_text_w_tooltip" name="input_text_w_tooltip" type="text">                
                </div>
                <script>
                    $('#input_text_w_tooltip-hint').popover();
                </script>
html
            ]
        ];
    }
}

