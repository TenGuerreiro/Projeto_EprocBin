<?php

namespace Tests\Unit\Showcaseable\Form\Unserialize;

use Tests\FormShowcaser;
use TRF4\UI\UI;
use TRF4\UI\Unserialize;

class DateIntervalTest extends FormShowcaser
{

    protected $name = '<code>dateInterval(string $namePrefix)</code>';
    protected $description = "
Retorna um array onde:
* Posição 0: A data de início
* Posição 1: A data de fim
";

    public function rendererExpectations(): array
    {
        return [
        ];
        // TODO refatorar esta classe. Esse tipo de teste é diferente dos testes tipo "Showcaser".
    }

    public function actual(): string
    {
        return UI::dateInterval('Date Interval', 'date_interval_5');
    }

    public function retrieveValue(string $method)
    {
        return Unserialize::$method()->dateInterval('date_interval_5');
    }
}