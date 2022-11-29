<?php

namespace Tests\Unit\Showcaseable\CommonBehaviors\Hint\Basic;


use Tests\Showcaser;
use TRF4\UI\Renderer\AbstractRenderer;
use TRF4\UI\Renderer\Bootstrap4 as BS4Renderer;
use TRF4\UI\UI;

class FileUploadTest extends Showcaser
{
    protected $name = "Default";
    protected $description = <<<MARKDOWN
    Hint default dentro de componente InputNumber
MARKDOWN;

    public function actual(): string
    {
        return UI::fileUpload('Fileupload', 'fileupload_w_label_hint_1')
            ->hint('My hint');
    }

    public function rendererExpectations(): array
    {
        return [
            [
                new BS4Renderer(), <<<html
                <div class="form-group">
                    <label class="w-100" for="fileupload_w_label_hint_1">
                        Fileupload
                        <i class="material-icons float-right"                        
                           data-content="My hint"
                           data-html="false"
                           data-toggle="popover"
                           data-trigger="hover"
                           id="fileupload_w_label_hint_1-hint">help_outline</i>
                    </label>                    
                    <div class="file-loading">
                        <input id="fileupload_w_label_hint_1" name="fileupload_w_label_hint_1" type="file">
                    </div>
                    <script type="text/javascript">csrfToken = $('#csrf-token').val(); $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': csrfToken } }); (function(){ $('#fileupload_w_label_hint_1').fileinput({ theme: 'fas', language: "pt-BR", required: false, validateInitialCount: true, showRemove: false, showCancel: false, uploadAsync: false, overwriteInitial: false, maxFileCount: 1, showUpload: false, initialPreviewAsData: false, uploadExtraData: {_token: csrfToken }, }); })(); $('#fileupload_w_label_hint_1-hint').popover();</script>
                </div>           
html
            ]
        ];
    }
}

