<?php

namespace Tests\Unit\Showcaseable\Select\Single\ActivatedBy;

class Metadata extends \Tests\SharedCardDirectoryMetadata
{
    public $title = "Activated By";
    protected $description = <<<MARKDOWN
Utilizando o método `activatedBy`, é possível sincronizar o estado de habilitação do select com base no estado de outro `select` ou `checkbox`, indicado no método por sua `id`.
MARKDOWN;
}