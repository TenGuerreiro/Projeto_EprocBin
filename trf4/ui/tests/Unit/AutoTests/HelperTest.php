<?php


namespace Tests\Unit\AutoTests;


use App\Helpers\PHPDocParser;
use Tests\TestCase;

class HelperTest extends TestCase
{

    /**
     * Comentário sobre a função
     */
    public function testGetCommentFromClass()
    {
        $actual = PHPDocParser::getPHPDoc('Tests\Unit\AutoTests\HelperTest', 'testGetCommentFromClass');
        $expected = "Comentário sobre a função";

        $this->assertEquals($expected, $actual);
    }

    /**
     * Exibir tabela com parâmetros relacionados.
     * @param string $label
     * @param string $nameAndId
     * @return Date
     */
    public function testWithTable()
    {

        $actual = PHPDocParser::getPHPDoc(self::class, 'testWithTable');
        // Utilizada tabela com html pois tabela com Markdown não possibilita adicionar classe e colspan https://www.markdownguide.org/extended-syntax/#tables
        $expected = <<<HTML
Exibir tabela com parâmetros relacionados.
<h5 class='mt-2'>Parâmetros</h5>
<table class="table table-sm table-bordered">
    <thead>
        <tr><th>Nome</th><th>Descrição</th></tr>
    </thead>
    <tbody><tr><td><p><code>string <b>\$label</b></p>
</td><td></td></tr><tr><td><p><code>string <b>\$nameAndId</b></p>
</td><td></td></tr></tbody>
</table>
HTML;

        $this->assertEquals($expected, $actual);
    }

}