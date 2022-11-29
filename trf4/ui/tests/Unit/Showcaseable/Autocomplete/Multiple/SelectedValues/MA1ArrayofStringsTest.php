<?php

namespace Tests\Unit\Showcaseable\Autocomplete\Multiple\SelectedValues;

use Tests\Showcaser;
use TRF4\UI\Helper;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class MA1ArrayofStringsTest extends Showcaser
{

    protected $description = "";

    public function actual(): string
    {
        $selectedValues = ['Santa Catarina'];

        return UI::multiAutocomplete(
            'Estados (array of strings)',
            'multi_ac_5',
            Helper::ajax('get', '/states_strings?country=Brazil')
        )
            ->showListAll()
            ->selectedValues($selectedValues);
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
<div class="form-group ui-autocomplete-wrapper" id="multi_ac_5-wrapper">
    <div class="d-flex justify-content-between">
        <label for="multi_ac_5">Estados (array of strings)</label>
        <button class="p-0 btn btn-link" id="multi_ac_5-listAll" title="Listar todos (Seta para baixo)" type="button"><small>Listar todos</small></button>
    </div>
    <input class="ui-autocomplete-input" id="multi_ac_5" name="multi_ac_5" placeholder="Pesquisar..." type="text">
</div>
<script>
    UI.multiAutocomplete.init('multi_ac_5',
        ["Santa Catarina"], "multi_ac_5_value", true, {
            method: "get",
            url: "\/states_strings?country=Brazil",
            labelFormatFn: function(k, v) {
                return UI.multiAutocomplete.defaultLabelInnerHtmlFormat(k, v);
            },
            valueFormatFn: function(k, v) {
                return UI.multiAutocomplete.defaultValueFormat(k, v);
            }
        }, 3);
</script>
html
            ]

        ];
    }

}