<?php


namespace Tests\Unit;


use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\Renderer\Infra;
use TRF4\UI\UI;
use Tests\TestCase;

class CheckboxTest extends TestCase
{

    const LABEL = 'label';
    const NAME = 'name';
    const VALUE = 'value';

    /**
     * @dataProvider dataProvider_WithOnlyLabelAndValue
     */
    public function testCheckboxWithOnlyLabelAndValue_shouldThrowException($renderer) {
        UI::config($renderer);
        $checkbox = UI::checkbox(self::LABEL, null, self::VALUE);

        $this->expectExceptionMessage("Erro ao renderizar checkbox: atributo 'name' não definido.");

        $checkbox->render();
    }

    /**
     * @dataProvider dataProvider_WithOnlyLabelAndValue
     */
    public function testCheckboxWithOnlyLabelAndValueAlt_shouldThrowException($renderer) {
        UI::config($renderer);
        $checkbox = UI::checkbox(self::LABEL)->value(self::VALUE);

        $this->expectExceptionMessage("Erro ao renderizar checkbox: atributo 'name' não definido.");

        $checkbox->render();

    }


    public function dataProvider_WithOnlyLabelAndValue() {
        return [
            [new Bootstrap4],
            [new Infra],
        ];
    }

}
