<?php

namespace Tests\Unit\FutureShowcaseable\FileUpload;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class OverrideTest extends Showcaser
{
    
    protected $description = <<<MARKDOWN
Cria um campo para upload de arquivo com opção override(subescreve arquivos anteriores). <br>
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
            new Bootstrap4(), <<<html
            <div class="form-group">
                <label for="fileupload_override">label</label>
                <input id="fileupload_override_Override" name="fileupload_override_Override" type="hidden" value="true">
                <div class="file-loading">
                    <input id="fileupload_override" name="fileupload_override" type="file" />
                </div>
                <script type="text/javascript">  
                    csrfToken = $('#csrf-token').val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    }); 
                    (function(){
                        $('#fileupload_override').fileinput({
                            theme: 'fas',
                            language: "pt-BR",
                            required: false,
                            validateInitialCount: true,
                            showRemove: false,
                            showCancel: false,
                            uploadAsync: false,
                            overwriteInitial: true,
                            maxFileCount: 1,
                            showUpload: false,
                            initialPreviewAsData: false,
                            uploadExtraData: {_token: csrfToken },
                        });
                    })();
                </script>
            </div>
html
            ]
        ];
    }

    public function actual(): string
    {
        return UI::fileUpload('label', 'fileupload_override')->overrideFile();
    }
}
