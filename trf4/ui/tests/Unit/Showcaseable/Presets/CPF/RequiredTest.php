<?php

namespace Tests\Unit\Showcaseable\Presets\CPF;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\Preset;

class RequiredTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Cria um campo preset do tipo CPF obrigatório(required), com máscara(mask) e padrão de validação (pattern)
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
                <div class="form-group">
                    <label for="preset_cpf_required">CPF<span class="text-danger">*</span></label>
                    <input class="form-control form-control-sm" id="preset_cpf_required" name="preset_cpf_required" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}" required type="text" />
                        <div class='invalid-feedback'>O campo "CPF" é obrigatório</div>
                </div>
                <script> 
                    (function(){ IMask(document.getElementById('preset_cpf_required'), { mask: '000.000.000-00', lazy: true }); })(); 
                </script>
html
            ]

        ];
    }

    public function actual(): string
    {
        return Preset::cpf('CPF', 'preset_cpf_required')->required();
    }
}