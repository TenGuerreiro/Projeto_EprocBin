<?php

namespace Tests\Unit\Showcaseable\CommonBehaviors\Hint;


use Tests\Showcaser;
use TRF4\UI\Renderer\AbstractRenderer;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class OutsideOfLabelTest extends Showcaser
{
    protected $name = "Outside of a label";
    protected $description = <<<MARKDOWN
No `inputText`, caso o `label` seja nulo, o ícone na dica será exibido dentro do próprio `<input>`.
MARKDOWN;

    public function actual(): string
    {
        return UI::inputText(null, 'input_text_w_label_hint_3')
            ->hint('My hint');
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer(), <<<html
              <div class="form-group">
                  <div class="input-hint-wrapper">
                      <input class="form-control form-control-sm" id="input_text_w_label_hint_3" name="input_text_w_label_hint_3" type="text">
                          <i class="material-icons float-right"
                            data-content="My hint"
                            data-html="false"
                            data-toggle="popover"
                            data-trigger="hover"
                            id="input_text_w_label_hint_3-hint">help_outline</i>                
                  </div>                    
              </div>
              <script>
                  $('#input_text_w_label_hint_3-hint').popover();
              </script>
html
            ]
        ];
    }
}

