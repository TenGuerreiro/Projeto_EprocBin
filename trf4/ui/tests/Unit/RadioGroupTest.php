<?php

use TRF4\UI\Renderer\Bootstrap4 as Bootstrap4Renderer;
use TRF4\UI\Renderer\Infra as InfraRenderer;
use TRF4\UI\UI;
use Tests\TestCase;

class RadioGroupTest extends TestCase
{


    protected function setUp(): void {
        UI::config(new Bootstrap4Renderer());
    }

    /**
     * @dataProvider dpValidateOptionsOnConstruct
     */
    public function testValidateOptionsOnConstruct($options, $expectedMsg) {
        $this->expectExceptionMessage($expectedMsg);
        UI::radioGroup('1', '2', $options);
    }

    public function dpValidateOptionsOnConstruct() {
        return [
            [[], 'É necessário haver pelo menos uma opção no construtor de RadioGroup.'],
            [['1', '2'], 'Opção inválida: deve ser uma instância de ' . \TRF4\UI\Labeled\Radio::class . ' ou um array com 3 valores (label, value, id).'],
            [['1'], 'Opção inválida: deve ser uma instância de ' . \TRF4\UI\Labeled\Radio::class . ' ou um array com 3 valores (label, value, id).']
        ];
    }


    /**
     * @dataProvider dpTestRadioGroupSimplesArray
     * @param $renderer
     * @param $expected
     */
    public function testRadioGroupSimplesArray($renderer, $expected) {
        // TODO em casos de VÁRIOS elementos, NÃO pode usar a ID como name
        // TODO ver se checkbox/select option/radio podem ser "setOptions"
        $label = 'Lista de radios';
        $name = 'customRadio';
        $options = [
            ['Radio 1', 1, 'customRadio1'],
            ['Radio 2', 2, 'customRadio2']
        ];
        UI::config($renderer);
        $actual = UI::radioGroup($label, $name, $options)->render();

        $this->assertHtmlEquals($expected, $actual);
    }

    public function dpTestRadioGroupSimplesArray() {
        return [
            [
                new Bootstrap4Renderer, <<<html
                <div class="form-group">
                    <span>Lista de radios</span>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" id="customRadio1" name="customRadio" type="radio" value="1"/>
                        <label class="custom-control-label" for="customRadio1">Radio 1</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" id="customRadio2" name="customRadio" type="radio" value="2"/>
                        <label class="custom-control-label" for="customRadio2">Radio 2</label>
                    </div>
                </div>
html
            ], [
                new InfraRenderer, <<<html
                <fieldset class="infraFieldset">
                    <legend class="infraLegend">&nbsp;Lista de radios&nbsp;</legend>
                    <div class="infraDivRadio">
                        <input class="infraRadio" id="customRadio1" name="customRadio" type="radio" value="1"/>
                        <label class="infraLabelOpcional infraLabelRadio" for="customRadio1">Radio 1</label>
                    </div>
                    <div class="infraDivRadio">
                        <input class="infraRadio" id="customRadio2" name="customRadio" type="radio" value="2"/>
                        <label class="infraLabelOpcional infraLabelRadio" for="customRadio2">Radio 2</label>
                    </div>
                </fieldset>
html
            ],
        ];
    }

}
