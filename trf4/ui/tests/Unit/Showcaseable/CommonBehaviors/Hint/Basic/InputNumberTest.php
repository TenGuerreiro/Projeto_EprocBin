<?php

namespace Tests\Unit\Showcaseable\CommonBehaviors\Hint\Basic;


use Tests\Showcaser;
use TRF4\UI\Renderer\AbstractRenderer;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class InputNumberTest extends Showcaser
{
    protected $name = "Default";
    protected $description = <<<MARKDOWN
    Hint default dentro de componente InputNumber
MARKDOWN;

    public function actual(): string
    {
        return UI::inputNumber('Input Number', 'input_number_w_label_hint_1')
            ->hint('My hint');
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer(), <<<html
               <div class="form-group">
                    <label class="w-100" for="input_number_w_label_hint_1">
                        Input Number
                        <i class="material-icons float-right"                        
                           data-content="My hint"
                           data-html="false"
                           data-toggle="popover"
                           data-trigger="hover"
                           id="input_number_w_label_hint_1-hint">help_outline</i>
                    </label>
                    <input class="form-control form-control-sm" id="input_number_w_label_hint_1" name="input_number_w_label_hint_1" type="number">                
                </div>
                <script>
                    $('#input_number_w_label_hint_1-hint').popover();
                </script>              
html
            ]
        ];
    }
}

