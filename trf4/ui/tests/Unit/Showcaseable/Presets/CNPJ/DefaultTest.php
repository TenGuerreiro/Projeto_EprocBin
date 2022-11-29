<?php

namespace Tests\Unit\Showcaseable\Presets\CNPJ;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\Preset;

class DefaultTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Cria um campo preset do tipo CNPJ, com máscara(mask) e padrão de validação (pattern)
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
                <div class="form-group">
                    <label for="preset_cnpj">CNPJ</label>
                    <input class="form-control form-control-sm" id="preset_cnpj" name="preset_cnpj" pattern="[0-9]{2}.[0-9]{3}.[0-9]{3}/[0-9]{4}-[0-9]{2}" type="text" />
                    <div class='invalid-feedback'>O campo "CNPJ" é obrigatório</div>
                </div>
                <script> 
                    (function(){ IMask(document.getElementById('preset_cnpj'), { mask: '00.000.000/0000-00', lazy: true }); })(); 
                </script>
html
            ]

        ];
    }

    public function actual(): string
    {
        return Preset::cnpj('CNPJ', 'preset_cnpj');
    }
}