<?php

namespace App\Helpers;

use TRF4\UI\Util\DirHash;

class CacheHelper
{
    protected $readFrom = "";
    protected $filePath = "";
    protected $currentHash = "";

    /**
     * Dependency constructor.
     * @param array $readFrom
     */
    public function __construct(array $readFrom)
    {
        $this->readFrom = $readFrom;
        $this->filePath = 'tmp/hash_file';
        if (is_file($this->filePath)) {
            $this->currentHash = file_get_contents($this->filePath);
        }
    }

    public function shouldReload()
    {
        $dirHash = new DirHash();
        
        $hash = $dirHash->hashDirectory($this->readFrom);

        if ($hash == $this->currentHash) {
            return false;
        } else {
            return $this->saveHashOnTempFile($hash);
        }
    }

    protected function saveHashOnTempFile($newHash): bool
    {
        if (!is_dir("tmp")) {
            mkdir("tmp", 777);
        }

        if (!is_file($this->filePath)) {
            fopen($this->filePath, "w");
        }
        return file_put_contents($this->filePath, $newHash);
    }

}
