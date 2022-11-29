<?php

namespace Tests\Unit\Showcaseable\Autocomplete\MinChars;

use Tests\Showcaser;
use TRF4\UI\Helper;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class MA1ArrayofStringsTest extends Showcaser
{

    public function actual(): string
    {
        return UI::autocomplete('Estados', 'ac_mc1', Helper::ajax('get', '/states_strings?country=Brazil'))
            ->minChars(1);
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
<div class="form-group ui-autocomplete-wrapper" id="ac_mc1-wrapper">
    <div class="d-flex justify-content-between">
        <label for="ac_mc1">Estados</label>
    </div>
    <input class="ui-autocomplete-input select-mode" id="ac_mc1" name="ac_mc1" placeholder="Pesquisar..." type="text">
</div>
<script>
    UI.multiAutocomplete.init('ac_mc1',
        [], "ac_mc1_value", false, {
            method: "get",
            url: "\/states_strings?country=Brazil",
            labelFormatFn: function(k, v) {
                return UI.multiAutocomplete.defaultLabelInnerHtmlFormat(k, v);
            },
            valueFormatFn: function(k, v) {
                return UI.multiAutocomplete.defaultValueFormat(k, v);
            }
        }, 1);
</script>
html
            ]

        ];
    }

}