<?php

namespace Tests\Unit\FutureShowcaseable\FileUpload;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class AjaxUploadTest extends Showcaser
{
    
    protected $description = <<<MARKDOWN
Cria um campo para upload de arquivo padrão com upload por Ajax assíncrono. <br>
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
            new Bootstrap4(), <<<html
            <div class="form-group">
                <label for="fileupload_ajaxurl">label</label>
                <div class="file-loading">
                    <input id="fileupload_ajaxurl" name="fileupload_ajaxurl" type="file"/>
                </div>
                <script type="text/javascript">  
                    csrfToken = $('#csrf-token').val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    }); 
                    
                    (function(){
                        $('#fileupload_ajaxurl').fileinput({
                            theme: 'fas',
                            language: "pt-BR", 
                            required: false,
                            validateInitialCount: true,
                            showRemove: false,
                            showCancel: false,
                            uploadUrl: 'teste.php',    
                            uploadAsync: true,               
                            overwriteInitial: false,
                            maxFileCount: 1,
                            showUpload: true,
                            initialPreviewAsData: false,                
                            uploadExtraData: {_token: csrfToken },
                        });
                    })();
                </script>
            </div>\n
html
            ]
        ];
    }

    public function actual(): string
    {
        return UI::fileUpload('label', 'fileupload_ajaxurl')->urlAjax('teste.php', true);
    }
}
