<?php


namespace Tests\Unit\Showcaseable\CommonBehaviors\Hint\Basic;


use Tests\SharedCardDirectoryMetadata;

class Metadata extends SharedCardDirectoryMetadata
{

    public $title = 'Uso Básico';

    // onde o método está localizado, subsescrevendo a class da qual os métodos dos componentes são lidos (UI)
    public $mainClass = 'TRF4\UI\Labeled\AbstractElementWithLabel';


    public $componentMethod = 'hint';

}