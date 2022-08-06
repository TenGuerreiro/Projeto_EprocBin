<?php


namespace Tests\Unit\Showcaseable\CommonBehaviors\NullLabel;


use Tests\SharedCardDirectoryMetadata;

class Metadata extends SharedCardDirectoryMetadata
{
    public $title = "Null Label";
    protected $description = <<<html
Diversos componentes possuem um subcomponente, `label`, criado ao parametrizar uma `string` no construtor.

Entretanto, quando esse parâmetro é `null`, o elemento que contém o rótulo não é criado.
html;


}