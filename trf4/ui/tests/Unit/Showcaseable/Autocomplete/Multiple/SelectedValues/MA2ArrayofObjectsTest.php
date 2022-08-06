<?php

namespace Tests\Unit\Showcaseable\Autocomplete\Multiple\SelectedValues;

use Tests\Showcaser;
use TRF4\UI\Helper;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class MA2ArrayofObjectsTest extends Showcaser
{

    protected $description = "";

    public function actual(): string
    {
        $selectedValues = [
            [
                'short' => 'RS',
                'name' => 'Rio Grande do Sul',
                'code' => 1,
            ],
        ];

        return UI::multiAutocomplete(
            'Estados (array of objects)',
            'multi_ac_6',
            Helper::ajax('get', '/states_objects?country=Brazil')->valueFormat('v.code')
        )
            ->selectedValues($selectedValues)
            ->showListAll()
            ->placeholder("Pesquisar...");
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
<div class="form-group ui-autocomplete-wrapper" id="multi_ac_6-wrapper">
    <div class="d-flex justify-content-between">
        <label for="multi_ac_6">Estados (array of objects)</label>
        <button class="p-0 btn btn-link" id="multi_ac_6-listAll" title="Listar todos (Seta para baixo)" type="button"><small>Listar todos</small></button>
    </div>
    <input class="ui-autocomplete-input" id="multi_ac_6" name="multi_ac_6" placeholder="Pesquisar... Pesquisar..." type="text">
</div>
<script>
    UI.multiAutocomplete.init('multi_ac_6',
        [{
            "short": "RS",
            "name": "Rio Grande do Sul",
            "code": 1
        }], "multi_ac_6_value", true, {
            method: "get",
            url: "\/states_objects?country=Brazil",
            labelFormatFn: function(k, v) {
                return UI.multiAutocomplete.defaultLabelInnerHtmlFormat(k, v);
            },
            valueFormatFn: function(k, v) {
                return v.code;
            }
        }, 3);
</script>
html
            ]

        ];
    }

}