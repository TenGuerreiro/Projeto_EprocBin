<?php

namespace Tests\Unit\FutureShowcaseable\FileUpload;

use Tests\Showcaser;
use TRF4\UI\Renderer\Bootstrap4;
use TRF4\UI\UI;

class InitFilesTest extends Showcaser
{

    protected $description = <<<MARKDOWN
Cria um campo para upload de arquivo com arquivos pré-selecionados, sendo exibidos como `preview` da biblioteca. <br>
MARKDOWN;

    public function rendererExpectations(): array
    {
        return [
            [
            new Bootstrap4(), <<<html
            <div class="form-group">
                <label for="fileupload_initfiles">label</label>
                <div class="file-loading">
                    <input id="fileupload_initfiles" multiple="true" name="fileupload_initfiles []" type="file"/>
                </div>
                <script type="text/javascript">  
                    csrfToken = $('#csrf-token').val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    }); 
                    (function(){
                        $('#fileupload_initfiles').fileinput({
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
                            initialPreview: ["https:\/\/i.picsum.photos\/id\/805\/201\/201.jpg?hmac=2pBK94gecW58ILtbguH-ydUIcM-ww40mlN2Sk8kYoVA","https:\/\/i.picsum.photos\/id\/72\/201\/201.jpg?hmac=6r9bfwQxK5Jd8ZMvTIppFqtS1El2wE0BBhGoPyyA0Hs","https:\/\/i.picsum.photos\/id\/860\/202\/202.jpg?hmac=0j5m8IE8zOhF3IkWBoE9IdNupOoO29AHH4o1efVgChU"],
                            initialPreviewConfig:[{"caption":"200.jpg","size":329892,"width":"120px","url":"\/","key":1,"previewAsData":true},{"caption":"201.jpg","size":329892,"width":"120px","url":"\/","key":1,"previewAsData":true},{"caption":"202.jpg","size":329892,"width":"120px","url":"\/","key":1,"previewAsData":true}]
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
        return UI::fileUpload('label', 'fileupload_initfiles')->multiple()->maxFiles(3)
        ->initFiles(array('url' => 
                        array(
                            "https://i.picsum.photos/id/805/201/201.jpg?hmac=2pBK94gecW58ILtbguH-ydUIcM-ww40mlN2Sk8kYoVA",
                            "https://i.picsum.photos/id/72/201/201.jpg?hmac=6r9bfwQxK5Jd8ZMvTIppFqtS1El2wE0BBhGoPyyA0Hs",
                            "https://i.picsum.photos/id/860/202/202.jpg?hmac=0j5m8IE8zOhF3IkWBoE9IdNupOoO29AHH4o1efVgChU"
                        ), 
                        'config' => 
                            array(
                                array(
                                    "caption" => "200.jpg", 
                                    "size" => 329892, 
                                    "width" => "120px", 
                                    "url" => "/", 
                                    "key" => 1,
                                    "previewAsData" => true
                                ),
                                array(
                                    "caption" => "201.jpg", 
                                    "size" => 329892, 
                                    "width" => "120px", 
                                    "url" => "/", 
                                    "key" => 1,
                                    "previewAsData" => true
                                ),
                                array(
                                    "caption" => "202.jpg", 
                                    "size" => 329892, 
                                    "width" => "120px", 
                                    "url" => "/", 
                                    "key" => 1,
                                    "previewAsData" => true
                                )
                            )
                        ));
    }
}
