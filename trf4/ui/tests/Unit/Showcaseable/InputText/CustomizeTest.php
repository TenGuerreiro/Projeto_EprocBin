<?php

namespace Tests\Unit\Showcaseable\InputText;


use Tests\Showcaser;
use TRF4\UI\Bootstrap4\InputText as BS4InputText;
use TRF4\UI\Component\InputText;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\Renderer\Infra;
use TRF4\UI\UI;

class CustomizeTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Esta é uma sintaxe alternativa de customização de subcomponentes.<br> Utilize-a caso queira realizar configurações mais complexas ou queira ter melhor suporte de autocomplete em sua IDE.
MARKDOWN;

    public function actual(): string
    {
        return UI::inputText('Input Text', 'alt_syntax_sub_config')
            ->customize(function (InputText $inputText) {
                if ($inputText instanceof BS4InputText) {

                    $inputText->_label
                        ->prepend('<b>')
                        ->append('</b>');

                    $inputText->_wrapper
                        ->class('col-5');
                }
            });
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer, <<<html
                <div class="form-group col-5">
                    <label for="alt_syntax_sub_config"><b>Input Text</b></label>
                    <input class="form-control form-control-sm" id="alt_syntax_sub_config" name="alt_syntax_sub_config" type="text"/>
                </div>
html
            ], [
                new Infra(), <<<html
                <div class="infraInputGroup">
                    <label class="infraLabelOpcional" for="alt_syntax_sub_config">Input Text</label>
                    <input class="infraText" id="alt_syntax_sub_config" name="alt_syntax_sub_config" type="text">
                </div>
html

            ]
        ];
    }
}

