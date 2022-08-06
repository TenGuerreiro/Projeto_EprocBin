<?php

namespace Tests\Unit\Showcaseable\Autocomplete\Multiple\SelectedValues;

use Tests\Showcaser;
use TRF4\UI\Helper;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class MA3MapTest extends Showcaser
{

    protected $description = "";

    public function actual(): string
    {
        $selectedValues = [3 => 'Paraná'];

        return UI::multiAutocomplete('Estados (map)', 'multi_ac_7', Helper::ajax('get', '/states_map?country=Brazil'))
            ->showListAll()
            ->selectedValues($selectedValues);
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
<div class="form-group ui-autocomplete-wrapper" id="multi_ac_7-wrapper">
    <div class="d-flex justify-content-between">
        <label for="multi_ac_7">Estados (map)</label>
        <button class="p-0 btn btn-link" id="multi_ac_7-listAll" title="Listar todos (Seta para baixo)" type="button"><small>Listar todos</small></button>
    </div>
    <input class="ui-autocomplete-input" id="multi_ac_7" name="multi_ac_7" placeholder="Pesquisar..." type="text">
</div>
<script>\n
    UI.multiAutocomplete.init(
    'multi_ac_7', 
    {
        "3": "Paran\u00e1"
    }, 
    "multi_ac_7_value", 
    true,
     {
        method: "get",
        url: "\/states_map?country=Brazil",
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