<?php

namespace Tests\Unit\Showcaseable\Select\Single\WithDependency;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;
use TRF4\UI\Util\AjaxCallback;

class WithDependencyReturningObjectsTest extends Showcaser
{
    protected $name = 'Callback returning array of objects';
    protected $description = <<<MD
Caso o retorno de sua requisição seja um array de objetos, é possível acessar as propriedades de cada linha no formato `v.PROPERTY_NAME`.
MD;

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
<div class="form-group">
    <label class="d-block" for="id_country3">Country</label>
    <select id="id_country3" name="id_country3">
        <option value="">Select a country...</option>
        <option value="Brazil">Brazil</option>
        <option value="Argentina">Argentina</option>
    </select>
</div>
<script>UI.PHPHelper.select.init('id_country3', "");</script>
<div class="form-group">
    <label class="d-block d-flex" for="select_dependency2">
        <span class="d-flex">States</span>
        <span id='select_dependency2-spinner' style="display:none;">
            <div class="d-flex text-primary ml-2 badge badge-light align-content-center badge-pill">
                <span class="mr-2">Carregando...</span> 
                <div class="spinner-border spinner-border-sm" role="status"> <span
                        class="sr-only">Loading...</span> </div>
            </div>
        </span>
    </label>
    <select id="select_dependency2" name="select_dependency2">
        <option value="">Select a state...</option>
    </select>
    <div class="dependency-feedback-message danger" id="select_dependency2-feedbackMessage"></div>
</div>
<script>
(function(){
    var country = document.getElementById("id_country3");
    UI.PHPHelper.select.addDependency(
        'country',
        "id_country3",
        "select_dependency2-spinner",
        "select_dependency2",
        'get', "states_objects",
        function () {
            return {params: {country: country.value}};
        },
        'Select a state...',
        "Select a country...",
        function (k, v) {
            return v.short;
        },
        function (k, v) {
            return "(" + v.short + ") " + v.name;
        },
        {},
        true);
})();
</script>
<script>UI.PHPHelper.select.init('select_dependency2', "");</script>
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
            UI::select('Country', 'id_country3', $countries)
                ->placeholder('Select a country...')
            .
            UI::select('States', 'select_dependency2')
                ->placeholder('Select a state...')
                ->dependencies(UI::dependency('country', 'id_country3', 'Select a country...'),
                    new AjaxCallback(
                        'get', 'states_objects', ['country' => 'country.value'],
                        'v.short', ' "(" + v.short + ") " + v.name'
                    )
                );
    }
}
