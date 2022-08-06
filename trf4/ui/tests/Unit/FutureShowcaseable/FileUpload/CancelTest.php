<?php

namespace Tests\Unit\FutureShowcaseable\FileUpload;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class CancelTest extends Showcaser
{
    
    protected $description = <<<MARKDOWN
Cria um campo para upload de arquivo com opção para cancelar de envio de arquivo. <br>
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
            new Bootstrap4(), <<<html
            <div class="form-group">
                <label for="fileupload_cancel">label</label>
                <div class="file-loading">
                    <input id="fileupload_cancel" name="fileupload_cancel" type="file" />
                </div>
                <script type="text/javascript">
                    csrfToken = $('#csrf-token').val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    }); 

                    (function(){
                        $('#fileupload_cancel').fileinput({
                            theme: 'fas',
                            language: "pt-BR",
                            required: false,
                            validateInitialCount: true,
                            showRemove: false,
                            showCancel: true,
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
        return UI::fileUpload('label', 'fileupload_cancel')->showCancel();
    }
}
