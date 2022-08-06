<?php

use Tests\TestCase;

use TRF4\UI\Form\File;
use TRF4\UI\Form\FileUtils;
use TRF4\UI\Form\FileFactory;

class FileUploadSubmit extends TestCase {

    # Testa saída da função que instancia objeto File
    public function testSingleFile() {
        
        $ext = "txt";
        if(!is_dir("./tmp_teste/")) {
            mkdir("./tmp_teste");
        }
        $path = realpath("./tmp_teste/");
        $fname = "teste".".".$ext;
        $filepath = $path."/".$fname;

        $file = fopen($filepath, "w");
        fwrite($file, "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sed arcu condimentum lacus convallis scelerisque. Phasellus egestas condimentum mi quis tincidunt. Ut vel viverra massa. Ut pretium, neque a faucibus imperdiet, eros nunc scelerisque nisi, ac venenatis turpis nunc eget velit. Cras metus leo, egestas eu accumsan eget, consequat et tellus. Curabitur porttitor lorem eget ipsum suscipit, et consectetur orci semper. Mauris efficitur lorem id bibendum sagittis. Morbi vehicula eros sed vestibulum convallis. Etiam aliquet mattis quam, at aliquet elit sagittis id. Etiam ornare convallis ligula, id auctor nisi pharetra eu.");
        fclose($file);

        $size = filesize($filepath);
        $mimeType = mime_content_type($filepath);

        $dataFile = array(
            "name"      => $fname,
            "type"      => $mimeType,
            "tmp_name"  => $filepath,
            "error"     => 0,
            "size"      => $size
        );
       
        $ret = FileUtils::montaArray($dataFile);
        $filesArr = $ret['data'];   
        $fileSize = $ret['size'];

        $fileExpected = FileFactory::instanciar($filesArr);

        $file = new File($fname, $filepath, $size, $mimeType, "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sed arcu condimentum lacus convallis scelerisque. Phasellus egestas condimentum mi quis tincidunt. Ut vel viverra massa. Ut pretium, neque a faucibus imperdiet, eros nunc scelerisque nisi, ac venenatis turpis nunc eget velit. Cras metus leo, egestas eu accumsan eget, consequat et tellus. Curabitur porttitor lorem eget ipsum suscipit, et consectetur orci semper. Mauris efficitur lorem id bibendum sagittis. Morbi vehicula eros sed vestibulum convallis. Etiam aliquet mattis quam, at aliquet elit sagittis id. Etiam ornare convallis ligula, id auctor nisi pharetra eu.", "", 0, 0);


        unlink($filepath);
        rmdir("./tmp_teste");
        $this->assertEquals($fileExpected, $file);
    }

}
