<?php

namespace Tests\Unit;

use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;
use Tests\TestCase;

class GenericElementTest extends TestCase
{


    protected function setUp(): void {
        UI::config(new Bootstrap4);
        parent::setUp();
    }


    /**
     * @dataProvider  dataProviderAttrThatRequiresParamShouldThrowException
     */
    public function testAttrThatRequiresParamShouldThrowException($method) {
        $this->expectExceptionMessage("Para o método $method não foi passado o parâmetro de valor");
        UI::el('div')->$method();
    }

    public function dataProviderAttrThatRequiresParamShouldThrowException() {
        return [
            ['style'],
            ['id'],
            ['class'],
            ['dataWhatever'],
            ['name'],
            ['target'],
            ['href'],
        ];
    }


    /**
     * @dataProvider  dataProviderBooleanAttrWithNonBooleanParamShouldThrowException
     */
    public function testBooleanAttrWithNotBooleanParamShouldThrowException($method, $param) {
        $this->expectExceptionMessage("O método $method só pode receber os valores true ou false. Valor recebido: $param.");
        UI::el('div')->$method($param);
    }

    public function dataProviderBooleanAttrWithNonBooleanParamShouldThrowException() {
        return [
            ['readonly', 'value'],
            ['disabled', 'true'],
            ['multiple', 'what'],
            ['checked', 'false'],
            ['selected', '0'],
            ['selected', '1'],
            ['selected', 0],
            ['selected', 1],
        ];
    }

    /**
     * @dataProvider  dataProviderAttrThatDontRequireParam
     */
    public function testAttrThatDontRequireParam($method, $expected) {
        $actual = UI::el('div')->$method();

        $this->assertHtmlEquals($expected, $actual);
    }

    public function dataProviderAttrThatDontRequireParam() {
        return [
            ['required', '<div required></div>'],
            ['readonly', '<div readonly="readonly"></div>'],
            ['disabled', '<div disabled="disabled"></div>'],
            ['multiple', '<div multiple="true"></div>'],
            ['checked', '<div checked="checked"></div>'],
            ['selected', '<div selected="selected"></div>'],
        ];
    }


    /**
     * @dataProvider  dataProviderBooleanAttrWithFalseParamShouldRenderNoAttr
     */
    public function testBooleanAttrWithFalseParamShouldRenderNoAttr($method) {
        $expected = '<div></div>';

        $actual = UI::el('div')->$method(false);

        $this->assertHtmlEquals($expected, $actual);
    }

    public function dataProviderBooleanAttrWithFalseParamShouldRenderNoAttr() {
        return [
            ['readonly'],
            ['disabled'],
            ['multiple'],
            ['checked'],
            ['selected'],
        ];
    }
}
