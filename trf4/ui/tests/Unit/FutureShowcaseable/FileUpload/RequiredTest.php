<?php

namespace Tests\Unit\FutureShowcaseable\FileUpload;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class RequiredTest extends Showcaser
{
    
    protected $description = <<<MARKDOWN
Cria um campo para upload de arquivos obrigatório.<br>
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
            new Bootstrap4(), <<<html
            <div class="form-group">
                <label for="fileupload_required">label<span class="text-danger">*</span></label>
                <div class="file-loading">
                    <input id="fileupload_required" name="fileupload_required" required type="file" />
                </div>
                <script type="text/javascript"> 
                    csrfToken = $('#csrf-token').val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    }); 

                    (function(){
                        $('#fileupload_required').fileinput({
                            theme: 'fas',
                            language: "pt-BR",
                            required: true,
                            validateInitialCount: true,
                            showRemove: false,
                            showCancel: false,
                            uploadAsync: false,
                            overwriteInitial: false,
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
        return UI::fileUpload('label', 'fileupload_required')->required();
    }
}
