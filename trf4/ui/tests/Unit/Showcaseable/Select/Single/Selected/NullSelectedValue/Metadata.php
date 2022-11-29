<?php


namespace Tests\Unit\Showcaseable\Select\Single\Selected\NullSelectedValue;

use Tests\SharedCardDirectoryMetadata;

class Metadata extends SharedCardDirectoryMetadata
{
    public $title = "Null selected values";
    public $description = <<<markdown
Caso o parâmetro do método `selected` seja um array vazio ou `null`, nenhuma opção será selecionada.
markdown;
}