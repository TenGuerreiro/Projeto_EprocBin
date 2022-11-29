<?php


namespace Tests\Unit\Showcaseable\CommonBehaviors\AccessKey\Basic;


use Tests\SharedCardDirectoryMetadata;

class Metadata extends SharedCardDirectoryMetadata
{
    protected $description = <<<html
O método `accesskey` foi sobrescrito para melhorar a acessibilidade dos clientes da UI, sublinhando o caracter parametrizado, caso exista, no label.

A lógica de sublinhamento é a seguinte:
1. Sublinhar a **primeira** letra da **primeira** palavra que correponder ao `\$accesskey`; 
2. Sublinha o **primeiro** caracter no `label` inteiro que correponder ao `\$accesskey`;
3. Não sublinhar

Obs.: o sublinhamento é `case insensitive`.
html;


    public $title = "Basic usage";
}