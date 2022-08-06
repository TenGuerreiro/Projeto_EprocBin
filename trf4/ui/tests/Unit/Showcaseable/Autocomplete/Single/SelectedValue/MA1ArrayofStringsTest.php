<?php

namespace Tests\Unit\Showcaseable\Autocomplete\Single\SelectedValue;

use Tests\Showcaser;
use TRF4\UI\Helper;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class MA1ArrayofStringsTest extends Showcaser
{

    protected $description = "";

    public function actual(): string
    {
        $selectedValue = 'Santa Catarina';

        return UI::autocomplete(
            'Estados (array of strings)',
            'ac_5',
            Helper::ajax('get', '/states_strings?country=Brazil')
        )
            ->showListAll()
            ->selectedValue($selectedValue);
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
<div class="form-group ui-autocomplete-wrapper" id="ac_5-wrapper">
    <div class="d-flex justify-content-between">
        <label for="ac_5">Estados (array of strings)</label>
        <button class="p-0 btn btn-link" id="ac_5-listAll" title="Listar todos (Seta para baixo)" type="button"><small>Listar todos</small></button>
    </div>
    <input class="ui-autocomplete-input select-mode" id="ac_5" name="ac_5" placeholder="Pesquisar..." type="text">
</div>
<script>
    UI.multiAutocomplete.init(
        'ac_5',
        ["Santa Catarina"], 
        "ac_5_value", 
        false, {
            method: "get",
            url: "\/states_strings?country=Brazil",
            labelFormatFn: function(k, v) {
                return UI.multiAutocomplete.defaultLabelInnerHtmlFormat(k, v);
            },
            valueFormatFn: function(k, v) {
                return UI.multiAutocomplete.defaultValueFormat(k, v);
            }
        },
        3);
</script>
html
            ]

        ];
    }

}