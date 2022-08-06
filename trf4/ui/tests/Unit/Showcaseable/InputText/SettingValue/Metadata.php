<?php


namespace Tests\Unit\Showcaseable\InputText\SettingValue;

use Tests\SharedCardDirectoryMetadata;

class Metadata extends SharedCardDirectoryMetadata
{
    public $title = "Value";
    public $description = <<<markdown
Com o método `value` é possível definir o valor do campo.
Caso o valor seja `null` ou uma `string` vazia, nenhum valor será definido.
markdown;
}