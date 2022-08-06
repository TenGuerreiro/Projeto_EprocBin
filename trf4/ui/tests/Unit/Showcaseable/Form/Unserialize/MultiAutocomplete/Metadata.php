<?php


namespace Tests\Unit\Showcaseable\Form\Unserialize\MultiAutocomplete;


use Tests\FormCardDirectoryMetadata;

class Metadata extends FormCardDirectoryMetadata
{
    public $title = "`multiAutocomplete(string \$namePrefix)`";
    protected $description = "Os valores de componentes complexos podem ser recuperados utilizando a classe `" . \TRF4\UI\Unserialize::class . "`.";
}