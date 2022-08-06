<?php

namespace Tests\Unit\Showcaseable\Autocomplete\Multiple\LabelFormat;

use Tests\Showcaser;
use TRF4\UI\Helper;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class MA1ArrayofObjectsTest extends Showcaser
{
    public $selectedValues = [['short' => 'RS', 'name' => 'Rio Grande do Sul', 'code' => 1]];

    public function actual(): string
    {
        return UI::multiAutocomplete(
            'Estados (array of objects)',
            'multi_ac_8',
            Helper::ajax('get', '/states_objects?country=Brazil')
        )->selectedValues($this->selectedValues);
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
<div class="form-group ui-autocomplete-wrapper" id="multi_ac_8-wrapper">
    <div class="d-flex justify-content-between">
        <label for="multi_ac_8">Estados (array of objects)</label>
    </div>
    <input class="ui-autocomplete-input" id="multi_ac_8" name="multi_ac_8" placeholder="Pesquisar..." type="text">
</div>
<script>
    UI.multiAutocomplete.init('multi_ac_8',
        [{
            "short": "RS",
            "name": "Rio Grande do Sul",
            "code": 1
        }], "multi_ac_8_value", true, {
            method: "get",
            url: "\/states_objects?country=Brazil",
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