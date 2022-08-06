<?php

namespace Tests\Unit;

use Tests\TestCase;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class InputTextTest extends TestCase
{
    public function test()
    {
        UI::config(new Bootstrap4());
        $actual = UI::inputText('Input Text XSS', 'input_text_xss')
            ->value('"<script>alert("prevent XSS");</script>')
            ->noValueSanitizing();
        $expected = <<<html
                <div class="form-group">
                    <label for="input_text_xss">Input Text XSS</label>
                    <input class="form-control form-control-sm" id="input_text_xss" name="input_text_xss" type="text" value=""<script>alert("prevent XSS");</script>"/>
                </div>
html;
        $this->assertHtmlEquals($expected, $actual);
    }
}
