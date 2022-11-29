<?php

namespace Tests\Unit\Showcaseable\Presets\NumeroProcesso;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\Preset;

class DefaultTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Cria um campo preset do Número do Processo, com máscara(mask) e padrão de validação (pattern)
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
                <div class="form-group">
                    <label for="preset_numeroprocesso">Nº Processo</label>
                    <input class="form-control form-control-sm" id="preset_numeroprocesso" name="preset_numeroprocesso" pattern="[0-9]{7}-[0-9]{2}.[0-9]{4}.[0-9]{1}.[0-9]{2}.[0-9]{4}" type="text" />
                    <div class='invalid-feedback'>O campo "Nº Processo" é obrigatório</div>
                </div>
                
                <script> 
                    (function(){ IMask(document.getElementById('preset_numeroprocesso'), { mask: '0000000-00.0000.0.00.0000', lazy: true }); })();
                </script> 
html
            ]

        ];
    }

    public function actual(): string
    {
        return Preset::numeroProcesso('Nº Processo', 'preset_numeroprocesso');
    }
}