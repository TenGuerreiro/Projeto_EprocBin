<?php

namespace Tests\Unit\Showcaseable\CommonBehaviors\Hint\Basic;


use Tests\Showcaser;
use TRF4\UI\Renderer\AbstractRenderer;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class DefaultTest extends Showcaser
{

    public function actual(): string
    {
        return UI::inputText('Input Text', 'input_text_w_label_hint_1')
            ->hint('My hint');
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer(), <<<html
               <div class="form-group">
                    <label class="w-100" for="input_text_w_label_hint_1">
                        Input Text
                        <i class="material-icons float-right"                        
                           data-content="My hint"
                           data-html="false"
                           data-toggle="popover"
                           data-trigger="hover"
                           id="input_text_w_label_hint_1-hint">help_outline</i>
                    </label>
                    <input class="form-control form-control-sm" id="input_text_w_label_hint_1" name="input_text_w_label_hint_1" type="text">                
                </div>
                <script>
                    $('#input_text_w_label_hint_1-hint').popover();
                </script>
                
html
            ]
        ];
    }
}

