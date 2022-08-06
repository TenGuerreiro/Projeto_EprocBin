<?php

namespace Tests\Unit\FutureShowcaseable\FileUpload;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class AllowedExtensionTest extends Showcaser
{
    
    protected $description = <<<MARKDOWN
Cria um campo para upload de arquivo com definição de formatos permitidos. <br>
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
            new Bootstrap4(), <<<html
            <div class="form-group">
                <label for="fileupload_allowed">label</label>
                <div class="file-loading">
                    <input id="fileupload_allowed" name="fileupload_allowed" type="file" />
                </div>
                <script type="text/javascript">  
                    csrfToken = $('#csrf-token').val();
                    
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    }); 
                    
                    (function(){
                        $('#fileupload_allowed').fileinput({
                            theme: 'fas',
                            language: "pt-BR",
                            required: false,
                            validateInitialCount: true,
                            showRemove: false,
                            showCancel: false,
                            uploadAsync: false,
                            allowedFileExtensions:['jpg', 'png', 'gif'],
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
        return UI::fileUpload('label', 'fileupload_allowed')->allowedFileExtensions(array('jpg','png','gif'));
    }
}
