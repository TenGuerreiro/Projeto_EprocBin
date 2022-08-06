<?php

namespace Tests\Unit\FutureShowcaseable\FileUpload;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class DeleteUrlTest extends Showcaser
{
    
    protected $description = <<<MARKDOWN
Cria um campo para upload de arquivo com URL de exclusão por Ajax. <br>
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
            new Bootstrap4(), <<<html
            <div class="form-group">
                <label for="fileupload_deleteurl">label</label>
                <div class="file-loading">
                    <input id="fileupload_deleteurl" name="fileupload_deleteurl" type="file" />
                </div>
                <script type="text/javascript"> 
                    csrfToken = $('#csrf-token').val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    });  
                    (function(){
                        $('#fileupload_deleteurl').fileinput({
                            theme: 'fas',
                            language: "pt-BR",
                            required: false,
                            validateInitialCount: true,
                            showRemove: false,
                            showCancel: false,
                            uploadAsync: false,
                            overwriteInitial: false,
                            maxFileCount: 1,
                            showUpload: false,
                            initialPreviewAsData: false,
                            uploadExtraData: {_token: csrfToken },
                            deleteUrl: 'delete.php',
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
        return UI::fileUpload('label', 'fileupload_deleteurl')->deleteUrl('delete.php');
    }
}
