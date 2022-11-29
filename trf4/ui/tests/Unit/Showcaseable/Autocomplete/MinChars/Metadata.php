<?php


namespace Tests\Unit\Showcaseable\Autocomplete\MinChars;


use Tests\SharedCardDirectoryMetadata;

class Metadata extends SharedCardDirectoryMetadata
{
    public $title = 'Min Chars';
    protected $description = <<<md
Com o método `minChars` é possível alterar a quantidade mínima de caracteres necessária para que a busca por dados seja feita.
 
Valor default: 3 
md;

}