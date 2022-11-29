<?php


namespace Tests\Unit\Showcaseable\CommonBehaviors\AccessKey\NoMatches;


use Tests\SharedCardDirectoryMetadata;

class Metadata extends SharedCardDirectoryMetadata
{
    public $title = "No matches in label";

    protected $description = "Caso o valor de `accesskey` não seja encontrado no `label`, nenhum caracter será sublinhado.";

}