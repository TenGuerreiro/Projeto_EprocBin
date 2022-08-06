<?php

namespace Tests\Unit\Showcaseable\Autocomplete\Single\LabelFormat;

use Tests\Showcaser;
use TRF4\UI\Helper;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class MA1ArrayofObjectsTest extends Showcaser
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
            'ac_8',
            Helper::ajax('get', '/states_objects?country=Brazil')
        )->selectedValue($this->selectedValue);
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
<div class="form-group ui-autocomplete-wrapper" id="ac_8-wrapper">
    <div class="d-flex justify-content-between">
        <label for="ac_8">Estado (array of objects)</label>
    </div>
    <input class="ui-autocomplete-input select-mode" placeholder="Pesquisar..." id="ac_8" name="ac_8" type="text">
</div>
<script>
    UI.multiAutocomplete.init('ac_8',
        [{
            "short": "RS",
            "name": "Rio Grande do Sul",
            "code": 1
        }], 
        "ac_8_value", 
        false, {
            method: "get",
            url: "\/states_objects?country=Brazil",
            labelFormatFn: function(k, v) {
                return UI.multiAutocomplete.defaultLabelInnerHtmlFormat(k, v);
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