<?php

namespace Tests\Unit\Showcaseable\Form\Unserialize\MultiAutocomplete;

use Tests\FormShowcaser;
use TRF4\UI\Helper;
use TRF4\UI\UI;
use TRF4\UI\Unserialize;

class MultiAutocomplete2ObjectArrayTest extends FormShowcaser
{

    protected $name = 'Array of objects';
    protected $description = <<<md
Quando a requisição retorna uma array de objetos, para que o componente determine o valor das tags/opções, é necessário utilizar o método `valueFormat`.

No exemplo a seguir, o retorno da requisição é similar ao seguinte:
```js
[
    {
        name: "Rio Grande do Sul",
        code: 1,
        short: "RS"
    },
    ... //outros estados
]
```
     
md;

    public function rendererExpectations(): array
    {
        return [
            // TODO refatorar esta classe. Esse tipo de teste é diferente dos testes tipo "Showcaser".
        ];
    }

    public function actual(): string
    {
        return UI::multiAutocomplete(
            'Autocomplete (array of objects)',
            'multi_ac_2',
            Helper::ajax('get', '/states_objects?country=Brazil')
                ->labelFormat('`(${v.short}) - ${v.name}`')
                ->valueFormat('v.code')
        )
            ->showListAll()
            ->placeholder("Pesquisar...");
    }


    public function retrieveValue(string $method)
    {
        return [
            'Valores' => Unserialize::$method()->multiAutocomplete('multi_ac_2'),
            'Objetos' => Unserialize::$method()->multiAutocompleteObjects('multi_ac_2')
        ];
    }

}