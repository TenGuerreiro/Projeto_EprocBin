<?php


namespace Tests\Unit\AutoTest;


use Tests\HtmlFormatter;
use Tests\TestCase;

class HtmlFormatterWithComplexScriptTest extends TestCase
{

    /**
     * @var HtmlFormatter
     */
    public $formatter;

    protected function setUp(): void
    {
        $this->formatter = new HtmlFormatter();

    }

    public function testHtmlWithScriptContainingComment()
    {
        $actual = $this->formatter->indent(file_get_contents(__DIR__ . '/complexHtmlActual.html'));

        $expected = file_get_contents(__DIR__ . '/complexHtmlExpected.html');
        $this->assertEquals($expected, $actual);
    }
}