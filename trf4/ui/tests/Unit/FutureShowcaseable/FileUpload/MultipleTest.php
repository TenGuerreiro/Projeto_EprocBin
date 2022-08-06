<?php

namespace Tests\Unit\FutureShowcaseable\FileUpload;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class MultipleTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Cria um campo para upload de arquivo múltiplo, no máximo 3 arquivos. <br>
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
            new Bootstrap4(), <<<html
            <div class="form-group">
                <label for="fileupload_multiple">label</label>
                <div class="file-loading">
                    <input id="fileupload_multiple" multiple="true" name="fileupload_multiple []" type="file" />
                </div>
                <script type="text/javascript"> 
                    csrfToken = $('#csrf-token').val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    }); 
 
                    (function(){
                        $('#fileupload_multiple').fileinput({
                            theme: 'fas',
                            language: "pt-BR",
                            required: false,
                            validateInitialCount: true,
                            showRemove: false,
                            showCancel: false,
                            uploadAsync: false,
                            overwriteInitial: false,
                            maxFileCount: 3,
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
        return UI::fileUpload('label', 'fileupload_multiple')->multiple()->maxFiles(3);
    }
}
