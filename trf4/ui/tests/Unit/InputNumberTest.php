<?php

namespace Tests\Unit;

use TRF4\UI\Bootstrap4\InputNumber as BS4InputNumber;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\Renderer\Infra;
use TRF4\UI\UI;
use Tests\TestCase;

class InputNumberTest extends TestCase
{

    /**
     * @dataProvider dataProvider
     */
    public function testInputNumber($label, $name, $renderer, $expected) {
        UI::config($renderer);
        $inputNumber = UI::inputNumber($label, $name);
        $actual = $inputNumber->render();
        $this->assertHtmlEquals($expected, $actual);
    }

    public function dataProvider() {
        return [
            [
                'Input Number', 'my_input_number', new Bootstrap4,
                '<div class="form-group">
                    <label for="my_input_number">Input Number</label>
                    <input class="form-control form-control-sm" id="my_input_number" name="my_input_number" type="number" />
                </div>
'
            ], [
                'Input Number', 'my_input_number', new Infra,
                '<div class="infraInputGroup">
                    <label class="infraLabelOpcional" for="my_input_number">Input Number</label>
                    <input class="infraNumber" id="my_input_number" name="my_input_number" type="number"/>
                </div>'
            ],
        ];
    }

#
#
#
#
    /**
     * @dataProvider dataProviderCustomizeInputNumber
     */
    public function testCustomizeInputNumber($expected) {
        UI::config(new Bootstrap4);


        $actual = UI::inputNumber('meu_input_number', 'my_input_number')
            ->customize(function (BS4InputNumber $inputNumber) {
                $inputNumber->_label
                    ->prepend('<b>')
                    ->append('</b>');
                $inputNumber->_wrapper->class('col-5');
            });

        $this->assertHtmlEquals($expected, $actual);
    }

    /**
     * @dataProvider dataProviderCustomizeInputNumber
     */
    public function testCustomizeInputNumber_altSyntax($expected) {
        UI::config(new Bootstrap4);

        $actual = UI::inputNumber('meu_input_number', 'my_input_number')
            ->_label('prepend', '<b>')
            ->_label('append', '</b>')
            ->_wrapper('class', 'col-5');

        $this->assertHtmlEquals($expected, $actual);
    }

    public function testInputNumber_MinMax() {
        UI::config(new Bootstrap4);

        $inputNumber = UI::inputNumber('Input Number', 'my_input_number')->max(10)->min(2)->step(0.5);
        $actual = $inputNumber->render();

        $expected = <<<html
            <div class="form-group">
                <label for="my_input_number">Input Number</label>
                <input class="form-control form-control-sm" id="my_input_number" max="10" min="2" name="my_input_number" step="0.5" type="number" />   
            </div>
html;
        $this->assertHtmlEquals($expected, $actual);
    }


    public function dataProviderCustomizeInputNumber() {
        return [
            [<<<html
                <div class="form-group col-5">
                    <label for="my_input_number"><b>meu_input_number</b></label>
                    <input class="form-control form-control-sm" id="my_input_number" name="my_input_number" type="number"/>
                </div>
html
            ]
        ];
    }

    public function testRequiredInput() {
        UI::config(new Bootstrap4);
        $input = UI::inputNumber('Input Number', 'my_input_number')->required();
        $actual = $input->render();
        $expected = <<<html
            <div class="form-group">
                <label for="my_input_number">Input Number<span class="text-danger">*</span></label>
                <input class="form-control form-control-sm" id="my_input_number" name="my_input_number" required type="number"/>
                <div class='invalid-feedback'>O campo "Input Number" é obrigatório</div>
            </div>
html;

        $this->assertHtmlEquals($expected, $actual);
    }

}
