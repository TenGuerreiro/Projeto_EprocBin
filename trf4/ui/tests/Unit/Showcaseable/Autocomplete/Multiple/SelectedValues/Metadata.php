<?php


namespace Tests\Unit\Showcaseable\Autocomplete\Multiple\SelectedValues;


use Tests\SharedCardDirectoryMetadata;

class Metadata extends SharedCardDirectoryMetadata
{
    protected $description = <<<md
Para preencher o campo com opções em sua criação, utilize o método `selectedValues`, que pode receber valores de duas formas:
1 - No caso de submissão de formulário e retroalimentação do componente, utilizando o retorno do método `multiAutocompleteObjects` da classe `Unserialize`
2 - Por meio do envio de uma estrutura **idêntica** à retornada pela fonte de dados, conforme os exemplos abaixo. 
md;

}