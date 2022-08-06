<?php


namespace Tests\Unit\AutoTest;


use Tests\HtmlFormatter;
use Tests\TestCase;

class HtmlFormatterTest extends TestCase
{

    /**
     * @var HtmlFormatter
     */
    public $formatter;


    protected function setUp(): void
    {
        $this->formatter = new HtmlFormatter();

    }

    public function testAssertHtmlEqualsScript()
    {
        $actual = $this->formatter->indent('<div class="hue"><a title="2">a</a><script type="text/javascript">(function(){while(1){return;}})()</script></div>');

        $expected = <<<html
<div class="hue">
    <a title="2">a</a>
    <script type="text/javascript">
        (function() {
            while (1) {
                return;
            }
        })()
    </script>
</div>
html;
        $this->assertEquals($expected, $actual);
    }

    public function testAttrFormatWithNoValue()
    {
        $expected = "<input required type='text'>";
        $actual = $this->formatter->indent("<input type='text' required>");
        $this->assertEquals($expected, $actual);
    }

    public function testHtmlWithScriptTypeTag()
    {
        $actual = $this->formatter->indent('<div class="hue"><a title="2">a</a><script type="text/script">(function(){while(1){return;}})()</script></div>');
        $expected = <<<html
<div class="hue">
    <a title="2">a</a>
    <script type="text/script">
        (function() {
            while (1) {
                return;
            }
        })()
    </script>
</div>
html;

        $this->assertEquals($expected, $actual);

    }

    /**
     * @dataProvider dpTestIndent
     * @param string $param
     * @param string $expected
     */
    public function testIndent(string $param, string $expected)
    {
        $actual = $this->formatter->indent($param);

        $this->assertEquals($expected, $actual);
    }


    public function dpTestIndent()
    {
        return [
            [

                "<div></div>
<script>
alert(1);
</script>",

                "<div></div>
<script>
    alert(1);
</script>"
            ], [
                "<div>
    <script>
alert(1);
    </script>
</div>",
                "<div>
    <script>
        alert(1);
    </script>
</div>"
            ], [
                "<div><div><script>alert(1);</script></div></div>",
                "<div>
    <div>
        <script>
            alert(1);
        </script>
    </div>
</div>"
            ], [
                "<div><div><script> alert(1);</script></div></div>",
                "<div>
    <div>
        <script>
            alert(1);
        </script>
    </div>
</div>"
            ],
        ];
    }

}