<?php

use PHPUnit\Framework\TestCase;
use TRF4\UI\Twig\Extension;
use Twig\Environment;
use Twig\Loader\ArrayLoader;

/**
 * Created by PhpStorm.
 * User: bxo
 * Date: 25/10/2018
 * Time: 14:55
 */
class TwigExtensionTest extends TestCase
{

    public function testBasic()
    {
        $actual = $this->renderTwigString(<<<html
{% form "my_id" "my_method" "my_action" %}
    Conteúdo do form
{% endform %}
html
        );

        $expected = <<<html
<form id="my_id" method="my_method" action="my_action" novalidate class="needs-validation">
    Conteúdo do form
</form>
html;

        $this->assertEquals($expected, $actual);
    }

    /**
     * Este teste é só para garantir que uma tag do próprio twig funciona como esperado
     */
    public function testTwigFor()
    {
        $actual = $this->renderTwigString(<<<twig
{% for v in [1,2] %}
    {{ v }} <br>
{% endfor %}
Teste de loop
twig
        );

        $expected = <<<html
    1 <br>
    2 <br>
Teste de loop
html;

        $this->assertEquals($expected, $actual);
    }

     /**
     * Este teste é só para garantir que uma tag do próprio twig funciona como esperado
     */
    public function testWithNestedTag()
    {
        $actual = $this->renderTwigString(<<<twig
{% form "my_id" "my_method" "my_action" %}
    {% for v in [1,2] %}
        {{ v }} <br>
    {% endfor %}
    Teste de loop
{% endform %}
twig
        );

        $expected = <<<html
<form id="my_id" method="my_method" action="my_action" novalidate class="needs-validation">
            1 <br>
            2 <br>
        Teste de loop
</form>
html;

        $this->assertEquals($expected, $actual);
    }

    private function renderTwigString(string $template): string
    {
        $name = 'mytwigfile';
        $loader = new ArrayLoader([
            $name => $template,
            'cache' => false,
            'debug' => true,
        ]);
        $twig = new Environment($loader);
        $twig->addExtension(new Extension());

        return $twig->render($name);
    }


}
