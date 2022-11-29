<?php

namespace Tests\Unit\Showcaseable\Presets\CPF;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\Preset;

class DefaultTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Cria um campo preset do tipo CPF, com máscara(mask) e padrão de validação (pattern)
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
                <div class="form-group">
                    <label for="preset_cpf">CPF</label>
                    <input class="form-control form-control-sm" id="preset_cpf" name="preset_cpf" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}" type="text" />
                    <div class='invalid-feedback'>O campo "CPF" é obrigatório</div>
                </div>
                <script> 
                    (function(){ IMask(document.getElementById('preset_cpf'), { mask: '000.000.000-00', lazy: true }); })(); 
                </script>
html
            ]

        ];
    }

    public function actual(): string
    {
        return Preset::cpf('CPF', 'preset_cpf');
    }
}