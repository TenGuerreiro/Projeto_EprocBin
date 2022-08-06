<?php


namespace Tests\Unit\AutoTest;


use Tests\HtmlFormatter;
use Tests\TestCase;

class SortAttributesTest extends TestCase
{

    public function testAttrNoValueRequired()
    {
        $formatter = new HtmlFormatter();
        $actual = $formatter->indent('<input type="text" required name="name">');
        $expected = <<<html
<input name="name" required type="text">
html;

        $this->assertEquals($expected, $actual);

    }

    public function testAttrBooleanValueFormatQuoteValue()
    {
        $formatter = new HtmlFormatter();
        $actual = $formatter->indent('<input type="text" name="name" required=true>');
        $expected = <<<html
<input name="name" required=true type="text">
html;

        $this->assertEquals($expected, $actual);
    }
 
    public function testPreventIdOrNameWithAttrSameName() {
        $this->assertEquals($expected, $actual);
        $formatter = new HtmlFormatter();
        $actual = $formatter->indent('<input class="form-control datetimepicker-input" data-target="#date_required" data-toggle="datetimepicker" id="date_required" name="date_required" pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d" required type="text">');
        $expected = <<<html
<input class="form-control datetimepicker-input" data-target="#date_required" data-toggle="datetimepicker" id="date_required" name="date_required" pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d" required type="text">
html;

        $this->assertEquals($expected, $actual);
    }
}