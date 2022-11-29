<?php

namespace Tests\Unit;

use Tests\TestCase;
use TRF4\UI\Renderer\Bootstrap4 as Bootstrap4Renderer;
use TRF4\UI\Renderer\Infra as InfraRenderer;
use TRF4\UI\UI;

class ButtonTest extends TestCase
{

    /**
     * @dataProvider dataProvider_button
     */
    public function testButtonSecondaryByDefault($innerHtml, $renderer, $expected)
    {
        UI::config($renderer);

        $button = UI::button($innerHtml);

        $actual = $button->render();

        $this->assertHtmlEquals($expected, $actual);
    }


    public function dataProvider_button()
    {
        return [
            [
                'str' => 'whatever',
                'renderer' => new Bootstrap4Renderer,
                'expected' => '<button class="btn btn-sm btn-secondary">whatever</button>'
            ], [
                'str' => 'whatever',
                'renderer' => new InfraRenderer,
                'expected' => '<button class="infraButton">whatever</button>'
            ],
        ];
    }

    /**
     * @dataProvider dataProvider_button
     */
    public function testButtonRendererGlobal($innerHtml, $renderer, $expected)
    {

        UI::config($renderer);
        $button = UI::button($innerHtml);


        $actual = $button->render();

        $this->assertHtmlEquals($expected, $actual);
    }


    /**
     * Esse ? sem ID s? pra garantir que o render in-place funciona
     * Issue #29 (https://git.trf4.jus.br/infra_php/infra_php_fontes/issues/29)
     */
    public function testPrimaryButtonWithIdTwig()
    {
        UI::config(new Bootstrap4Renderer);


        $expected = <<<h
            <button
                class="btn btn-sm btn-primary"
                >Atualizar os dados</button>
h;
        $actual = $this->renderTwigString(
            "{{ ui.button('Atualizar os dados').primary()|raw }}",
            ['ui' => new UI()]
        );


        $this->assertHtmlEquals($expected, $actual);
    }

    /**
     * Issue #29 (https://git.trf4.jus.br/infra_php/infra_php_fontes/issues/29)
     */
    public function testPrimaryButtonTwig()
    {
        UI::config(new Bootstrap4Renderer);


        $expected = <<<h
            <button 
                class="btn btn-sm btn-primary"
                id="btn-atualizar-criteris-exibicao">
                    Atualizar os dados
            </button>
h;
        $actual = $this->renderTwigString(
            <<<html
                {{ ui.button('Atualizar os dados')
                     .primary()
                     .id('btn-atualizar-criteris-exibicao')|raw }}
html
            , ['ui' => new UI()]
        );


        $this->assertHtmlEquals($expected, $actual);
    }


}
