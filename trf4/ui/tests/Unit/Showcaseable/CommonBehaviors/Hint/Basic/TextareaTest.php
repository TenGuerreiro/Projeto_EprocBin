<?php

namespace Tests\Unit\Showcaseable\CommonBehaviors\Hint\Basic;


use Tests\Showcaser;
use TRF4\UI\Renderer\AbstractRenderer;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class TextareaTest extends Showcaser
{
    protected $name = "Default";
    protected $description = <<<MARKDOWN
    Hint default dentro de Textarea
MARKDOWN;

    public function actual(): string
    {

        return UI::textarea('Textarea', 'default_textarea_hint')
            ->hint('My hint');
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer(), <<<html
                <div class="form-group">
                    <label class="w-100" for="default_textarea_hint">
                        Textarea
                       <i class="material-icons float-right"                        
                           data-content="My hint"
                           data-html="false"
                           data-toggle="popover"
                           data-trigger="hover"
                           id="default_textarea_hint-hint">help_outline</i>
                    </label>
                    <textarea class="form-control form-group" id="default_textarea_hint" name="default_textarea_hint"></textarea>
                    <script type="text/javascript">
                        $('#default_textarea_hint-hint').popover();
                    </script>
                </div>
                
html
            ]
        ];
    }
}

