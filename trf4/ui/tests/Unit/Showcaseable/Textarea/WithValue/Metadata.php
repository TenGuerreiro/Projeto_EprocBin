<?php


namespace Tests\Unit\Showcaseable\Textarea\WithValue;


use Tests\SharedCardDirectoryMetadata;

class Metadata extends SharedCardDirectoryMetadata
{
    public $title = "With Value";
    protected $description = "Para definir um valor na inicialização, utilize os métodos `value` ou `innerHTML`.";
}