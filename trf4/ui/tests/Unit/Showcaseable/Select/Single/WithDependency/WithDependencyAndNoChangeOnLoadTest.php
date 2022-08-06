<?php

namespace Tests\Unit\Showcaseable\Select\Single\WithDependency;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;
use TRF4\UI\Util\AjaxCallback;

class WithDependencyAndNoChangeOnLoadTest extends Showcaser
{
    protected $name = 'Pre-loading select with dependency';
    protected $description = <<<MD
Caso o select já venha populado com options, seu evento `onchange` não será disparado no carregamento da página. 

Isso impede que as opções carregadas sejam substituídas por um placeholder.

> AVISO: no futuro esse método será removido, pois, ao utilizar o conjunto `selected()` + `dependencies`, o callback será executado no servidor, antes que o select seja renderizado. Isso eliminará a necessidade de ter código redundante.
MD;


    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
<div class="form-group">
    <label class="d-block" for="id_country4">Country</label>
    <select id="id_country4" name="id_country4">
        <option value="">Select a country...</option>
        <option value="Brazil">Brazil</option>
        <option value="Argentina">Argentina</option>
    </select>
</div>
<script>UI.PHPHelper.select.init('id_country4', "");</script>
<div class="form-group">
    <label class="d-block d-flex" for="select_dependency3">
        <span class="d-flex">States</span>
        <span id='select_dependency3-spinner' style="display:none;">
            <div class="d-flex text-primary ml-2 badge badge-light align-content-center badge-pill">
                <span class="mr-2">Carregando...</span> 
                <div class="spinner-border spinner-border-sm" role="status"> <span
                        class="sr-only">Loading...</span> </div>
            </div>
        </span>
    </label>
    <select id="select_dependency3" name="select_dependency3">
        <option value="">Select a state...</option>
        <option value="0">1</option>\n
        <option selected="selected" value="1">2</option>\n
    </select>
    <div class="dependency-feedback-message danger" id="select_dependency3-feedbackMessage"></div>
</div>
<script>
(function(){
    var country = document.getElementById("id_country4");
    
    UI.PHPHelper.select.addDependency(
        'country',
        "id_country4",
        "select_dependency3-spinner",
        "select_dependency3",
        'get', "states",
        function () {
            return {params: {country: country.value}};
        },
        'Select a state...',
        "Select a country...",
        function (k, v) {
            return k;
        },
        function (k, v) {
            return v;
        },
        {},
        false);
    })();
</script>
<script>UI.PHPHelper.select.init('select_dependency3', "");</script>
html

            ]
        ];
    }

    public function actual(): string
    {
        $countries = [
            'Brazil' => 'Brazil',
            'Argentina' => 'Argentina'
        ];

        return
            UI::select('Country', 'id_country4', $countries)
                ->placeholder('Select a country...')
            .
            UI::select('States', 'select_dependency3', [1, 2])
                ->selected(1)
                ->placeholder('Select a state...')
                ->dependencies(UI::dependency('country', 'id_country4', 'Select a country...'),
                    new AjaxCallback(
                        'get', 'states', ['country' => 'country.value'],
                        'k', 'v'
                    )
                );
    }
}
