<?php

namespace Tests\Unit\Showcaseable\InputText;


use Tests\Showcaser;
use TRF4\UI\Bootstrap4\InputText as BS4InputText;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class SubcomponentConfigurationTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Este é um exemplo de configuração dos subcomponentes `label` e `wrapper`:
* No label, é chamado o método `prepend`, que prefixa seu conteúdo (inner html) com o valor parametrizado.</li>
* Também no label, o método `append` adiciona a string parametrizada como sufixo de seu conteúdo</li>
* Do `wrapper` é chamado o método `class`, adicionando a ele a string `col-5`.</li>
MARKDOWN;

    public function actual(): string
    {
        return UI::inputText('Input Text', 'configured_input_text')
            ->_label('prepend', '<b>')
            ->_label('append', '</b>')
            ->_wrapper('class', 'col-5');
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer(), <<<html
                <div class="form-group col-5">
                    <label for="configured_input_text"><b>Input Text</b></label>
                    <input class="form-control form-control-sm" id="configured_input_text" name="configured_input_text" type="text"/>
                </div>
html
            ]
        ];
    }
}

