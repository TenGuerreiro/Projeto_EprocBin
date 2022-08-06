<?php


namespace Tests\Unit\Showcaseable\Autocomplete\Single\LabelFormat;


use Tests\SharedCardDirectoryMetadata;

class Metadata extends SharedCardDirectoryMetadata
{
    protected $description = <<<md
Para formatar o rótulo das opções, utilize o método `labelFormat` do objeto `ajax`.
Esse método permite tratar usando JS os valores `k` e `v`, que são, respectivamente, a chave e o valor de cada opção.

No caso de uma fonte de dados que retorne um array de objetos, por padrão, o label será composto por cada uma de suas propriedades separadas por ` - `.

> Nota: O parâmetro deve ser uma expressão única, visto que será precedida por `return`. 

Os exemplos a seguir possuem `\$this->selectedValue` com o seguinte valor:
```php
    \$this->selectedValue = [
        [
            'short' => 'RS', 
            'name' => 'Rio Grande do Sul', 
            'code' => 1
        ]
    ];
```  
md;

}