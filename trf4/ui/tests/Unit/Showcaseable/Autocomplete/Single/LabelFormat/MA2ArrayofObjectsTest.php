<?php

namespace Tests\Unit\Showcaseable\Autocomplete\Single\LabelFormat;

use Tests\Showcaser;
use TRF4\UI\Helper;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;


class MA2ArrayofObjectsTest extends Showcaser
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
            'ac_9',
            Helper::ajax('get', '/states_objects?country=Brazil')
                ->labelFormat('v.short')
        )->selectedValue($this->selectedValue);
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
<div class="form-group ui-autocomplete-wrapper" id="ac_9-wrapper">
    <div class="d-flex justify-content-between">
        <label for="ac_9">Estado (array of objects)</label>
    </div>
    <input class="ui-autocomplete-input select-mode" id="ac_9" name="ac_9" placeholder="Pesquisar..." type="text">
</div>
<script>
    UI.multiAutocomplete.init('ac_9',
        [{
            "short": "RS",
            "name": "Rio Grande do Sul",
            "code": 1
        }], 
        "ac_9_value",
        false, 
        {
            method: "get",
            url: "\/states_objects?country=Brazil",
            labelFormatFn: function(k, v) {
                return v.short;
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