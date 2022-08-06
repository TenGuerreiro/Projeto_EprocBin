<?php


namespace Tests\Unit\Showcaseable\Form\Unserialize;


use Tests\FormCardDirectoryMetadata;
use TRF4\UI\Unserialize;

class Metadata extends FormCardDirectoryMetadata
{
    protected $description = "Os valores de componentes complexos podem ser recuperados utilizando a classe `" . \TRF4\UI\Unserialize::class . "`.

";
    public $title = Unserialize::class;
}