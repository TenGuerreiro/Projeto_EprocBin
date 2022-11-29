<?php

namespace Tests\Unit\Showcaseable\Select\Single\WithDependency;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;
use TRF4\UI\Util\AjaxCallback;

class RWithDependencyTest extends Showcaser
{
    protected $name = 'With Dependency';
    protected $description = <<<MD
É possível que um select tenha `options` carregadas conforme os dados de outro. Para isso, serve o método `dependencies()`.<br>
O primeiro parâmetro é um objeto do tipo `Dependency`, que recebe três parâmetros:
* `string \$name`: É o nome atribuído à dependência. Serve para ser posteriormente utilizado pelo callback.
* `string \$inputId`: ID do select do qual este depende
* `string \$placeholderIfNull`: Placeholder a ser usado caso a dependência não possua valor selecionado. (atualmente não suportado)

> Obs.: Este comportamento é experimental e, por enquanto, apenas uma dependência é suportada.

O segundo parâmetro é o callback - a chamada que será executada após as dependências possuam valor válido/selecionado.<br>
É composto por um objeto (atualmente, apenas `AjaxCallback`, que possui os seguintes parâmetros:
* `string \$method`: O método da requisição HTTP a ser feita (get ou post)
* `string \$url`: A URL que trará o JSON contendo os dados de resposta
* `array \$params`São os parâmetros que serão enviada à url do callback. É aqui que o `\$name` do `UI::dependency(...)` será usado. (veja no exemplo)
* `string \$valueAttr` É o atributo que será usado como `value` da `option` gerada.
* `string \$innerHTMLAttr`É o atributo que será usado como `innerHTML`(rótulo) da option gerada


Neste exemplo, um GET em `states` retorna um array, ou seja: chave => valor.<br>
Por isso,  `k` torna-se o `value` das opções e<br>
`v` torna-se o `innerHTML` delas.<br><br>

Caso a URL retornasse um array de objetos, como por exemplo:
```js
[
    {id: 1, description: "Rio Grande do Sul"},
    {id: 2, description: "Santa Catarina"}
    ...
]
```

* o parâmetro com valor `"k"` seria `"v.id"` e
* o parâmetro com valor `"v"` seria `"v.description"`.

MD;

    public function rendererExpectations(): array
    {
        return [
            [
                new Bootstrap4(), <<<html
<div class="form-group">
    <label class="d-block" for="id_country2">Country</label>
    <select id="id_country2" name="id_country2">
        <option value="">Select a country...</option>
        <option value="Brazil">Brazil</option>
        <option value="Argentina">Argentina</option>
    </select>
</div>
<script>UI.PHPHelper.select.init('id_country2', "");</script>
<div class="form-group">
    <label class="d-block d-flex" for="select_dependency">
        <span class="d-flex">States</span>
        <span id='select_dependency-spinner' style="display:none;">
            <div class="d-flex text-primary ml-2 badge badge-light align-content-center badge-pill">
                <span class="mr-2">Carregando...</span> 
                <div class="spinner-border spinner-border-sm" role="status"> <span
                        class="sr-only">Loading...</span> </div>
            </div>
        </span>
    </label>
    <select id="select_dependency" name="select_dependency">
        <option value="">Select a state...</option>
    </select>
    <div class="dependency-feedback-message danger" id="select_dependency-feedbackMessage"></div>
</div>
<script>
(function(){
    var country = document.getElementById("id_country2");
    
    UI.PHPHelper.select.addDependency(
        'country',
        "id_country2",
        "select_dependency-spinner",
        "select_dependency",
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
        true);
    })();
</script>
<script>UI.PHPHelper.select.init('select_dependency', "");</script>
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
            UI::select('Country', 'id_country2', $countries)
                ->placeholder('Select a country...')
            .
            UI::select('States', 'select_dependency')
                ->placeholder('Select a state...')
                ->dependencies(UI::dependency('country', 'id_country2', 'Select a country...'),
                    new AjaxCallback(
                        'get', 'states', ['country' => 'country.value'],
                        'k', 'v'
                    )
                );
    }
}
