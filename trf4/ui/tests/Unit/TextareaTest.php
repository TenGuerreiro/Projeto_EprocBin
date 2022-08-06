<?php

namespace Tests\Unit;

use Tests\TestCase;
use TRF4\UI\Config;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class TextareaTest extends TestCase
{

    public function testUserDefaultInvalidFeedback()
    {
        UI::config(new Bootstrap4);
        Config::setDefaultFeedbackForInvalidField("The field \"%s\" is required.");

        $actual = UI::textarea('textarea', 'my_textarea')->required()->render();

        $expected = <<<html
            <div class="form-group">
                <label for="my_textarea">textarea<span class="text-danger">*</span></label>
                <textarea class="form-control form-group" id="my_textarea" name="my_textarea" required></textarea>
                <div class='invalid-feedback'>The field "textarea" is required.</div>
            </div>
html;

        $this->assertHtmlEquals($expected, $actual);
    }

    public function testUserDefaultInvalidFeedbackWithoutLabelParam()
    {
        UI::config(new Bootstrap4);
        Config::setDefaultFeedbackForInvalidField("Este campo é obrigatório.");
        $actual = UI::textarea('textarea', 'my_textarea')->required()->render();

        $expected = <<<html
            <div class="form-group">
                <label for="my_textarea">textarea<span class="text-danger">*</span></label>
                <textarea class="form-control form-group" id="my_textarea" name="my_textarea" required></textarea>
                <div class='invalid-feedback'>Este campo é obrigatório.</div>
            </div>
html;

        $this->assertHtmlEquals($expected, $actual);
    }

}
