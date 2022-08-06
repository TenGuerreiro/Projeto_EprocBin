<?php

namespace Tests\Unit\Showcaseable\Presets\NumeroProcesso;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\Preset;

class RequiredTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Cria um campo preset do Número do Processo obrigatório(required), com máscara(mask) e padrão de validação (pattern)
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
                <div class="form-group">
                    <label for="preset_numeroprocesso_required">Nº Processo<span class="text-danger">*</span></label>
                    <input class="form-control form-control-sm" id="preset_numeroprocesso_required" name="preset_numeroprocesso_required" pattern="[0-9]{7}-[0-9]{2}.[0-9]{4}.[0-9]{1}.[0-9]{2}.[0-9]{4}" required type="text" />
                    <div class='invalid-feedback'>O campo "Nº Processo" é obrigatório</div>
                </div>
                <script> (function(){ IMask(document.getElementById('preset_numeroprocesso_required'), { mask: '0000000-00.0000.0.00.0000', lazy: true }); })();</script> 
html
            ]

        ];
    }

    public function actual(): string
    {
        return Preset::numeroProcesso('Nº Processo', 'preset_numeroprocesso_required')->required();
    }
}