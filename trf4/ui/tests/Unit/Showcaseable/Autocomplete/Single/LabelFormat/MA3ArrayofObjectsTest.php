<?php

namespace Tests\Unit\Showcaseable\Autocomplete\Single\LabelFormat;

use Tests\Showcaser;
use TRF4\UI\Helper;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class MA3ArrayofObjectsTest extends Showcaser
{
    public $selectedValue = [
        'short' => 'RS',
        'name' => 'Rio Grande do Sul',
        'code' => 1
    ];

    public function actual(): string
    {
        return UI::autocomplete(
            'Estado (array of objects)',
            'ac_10',
            Helper::ajax('get', '/states_objects?country=Brazil')
                ->labelFormat('v.short + " - " + v.name ')
        )->selectedValue($this->selectedValue);
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
<div class="form-group ui-autocomplete-wrapper" id="ac_10-wrapper">
    <div class="d-flex justify-content-between">
        <label for="ac_10">Estado (array of objects)</label>
    </div>
    <input class="ui-autocomplete-input select-mode" id="ac_10" name="ac_10" placeholder="Pesquisar..." type="text">
</div>
<script>
    UI.multiAutocomplete.init('ac_10',
        [{
            "short": "RS",
            "name": "Rio Grande do Sul",
            "code": 1
        }], 
        "ac_10_value", 
        false, {
            method: "get",
            url: "\/states_objects?country=Brazil",
            labelFormatFn: function(k, v) {
                return v.short + " - " + v.name;
            },
            valueFormatFn: function(k, v) {
                return UI.multiAutocomplete.defaultValueFormat(k, v);
            }
        },
        3
    );
</script>
html
            ]

        ];
    }

}