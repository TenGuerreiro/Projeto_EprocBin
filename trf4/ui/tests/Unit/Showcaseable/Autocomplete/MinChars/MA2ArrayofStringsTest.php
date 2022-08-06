<?php

namespace Tests\Unit\Showcaseable\Autocomplete\MinChars;

use Tests\Showcaser;
use TRF4\UI\Helper;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class MA2ArrayofStringsTest extends Showcaser
{

    public function actual(): string
    {
        return UI::multiAutocomplete('Estados', 'ac_mc2', Helper::ajax('get', '/states_strings?country=Brazil'))
            ->minChars(2);
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
<div class="form-group ui-autocomplete-wrapper" id="ac_mc2-wrapper">
    <div class="d-flex justify-content-between">
        <label for="ac_mc2">Estados</label>
    </div>
    <input class="ui-autocomplete-input" id="ac_mc2" name="ac_mc2" placeholder="Pesquisar..." type="text">
</div>
<script>
    UI.multiAutocomplete.init('ac_mc2',
        [], "ac_mc2_value", true, {
            method: "get",
            url: "\/states_strings?country=Brazil",
            labelFormatFn: function(k, v) {
                return UI.multiAutocomplete.defaultLabelInnerHtmlFormat(k, v);
            },
            valueFormatFn: function(k, v) {
                return UI.multiAutocomplete.defaultValueFormat(k, v);
            }
        }, 2);
</script>
html
            ]

        ];
    }

}