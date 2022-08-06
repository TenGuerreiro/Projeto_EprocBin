<?php

namespace Tests\Unit\Showcaseable\Form\Unserialize\MultiAutocomplete;

use Tests\FormShowcaser;
use TRF4\UI\Helper;
use TRF4\UI\UI;
use TRF4\UI\Unserialize;

class MultiAutocomplete3MapTest extends FormShowcaser
{

    protected $name = 'Map';
    protected $description = <<<md
Alternativamente, é possível retornar um mapa (em javascript: um objeto), que corresponde a um array do PHP com índice nomeado.

No exemplo abaixo, a requisição retorna um mapa `code => name`. Por exemplo:
```js
{
    1: "Rio Grande do Sul",
    2: "Paraná",
    ... // outros estados 
}
```

Dessa forma, o componente tratará por padrão:
- como valor, a chave (nome da propriedade) do mapa (ex.: 1)
- como rótulo, o valor de cada propriedade do mapa (ex.: Rio Grande do Sul)
md;


    public function rendererExpectations(): array
    {
        return [
            // TODO refatorar esta classe. Esse tipo de teste é diferente dos testes tipo "Showcaser".
        ];
    }

    public function actual(): string
    {
        return UI::multiAutocomplete('Estados (map)', 'multi_ac_1', Helper::ajax('get', '/states_map?country=Brazil'))
            ->showListAll()
            ->placeholder("Pesquisar...");
    }

    public function retrieveValue(string $method)
    {
        return [
            'Valores' => Unserialize::$method()->multiAutocomplete('multi_ac_1'),
            'Objetos' => Unserialize::$method()->multiAutocompleteObjects('multi_ac_1')
        ];
    }

}