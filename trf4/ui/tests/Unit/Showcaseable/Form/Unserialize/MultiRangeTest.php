<?php

namespace Tests\Unit\Showcaseable\Form\Unserialize;

use Tests\FormShowcaser;
use TRF4\UI\UI;
use TRF4\UI\Unserialize;

class MultiRangeTest extends FormShowcaser
{

    protected $name = '<code>multiRange(string $namePrefix)</code>';
    protected $description = "
Retorna um array onde:
* Posição 0: O valor menor
* Posição 1: O valor maior
";

    public function rendererExpectations(): array
    {
        return [
            // TODO refatorar esta classe. Esse tipo de teste é diferente dos testes tipo "Showcaser".
            // Deveria ser:
            /*
    "array (
      0 => '2',
      1 => '5',
    )";

             */
        ];
    }

    public function actual(): string
    {
        return UI::multiRange('Multi Range', 'multiRange4', 0, 10);
    }

    public function retrieveValue(string $method)
    {
        return Unserialize::$method()->multiRange('multiRange4');
    }

}