<?php

namespace TRF4\UI\Util;

class DirHash
{

    public function __construct()
    {
    }

    /**
     * Generate an MD5 hash string from the contents of a directory.
     *
     * @param string|array $directory
     * @return bool|string
     */

    public function hashDirectory($directories)
    {
        $files = [];

        if (!is_array($directories)) {
            $directory = $directories;

            $dir = dir($directory);

            if (!is_dir($directory)) {
                return false;
            }

            $files = $this->getDirRead($directory, $dir);

            $dir->close();
        } else {
            foreach ($directories as $directory) {
                $dir = dir($directory);

                $files = $this->getDirRead($directory, $dir);

                $dir->close();
            }
        }

        return md5(implode('', $files));
    }

    private function getDirRead($path, $dir)
    {
        $arrFiles = [];
        while (false !== ($file = $dir->read())) {
            if ($file != '.' and $file != '..') {
                if (is_dir($path . '/' . $file)) {
                    $arrFiles[] = $this->hashDirectory($path . '/' . $file);
                } else {
                    $arrFiles[] = md5_file($path . '/' . $file);
                }
            }
        }
        return $arrFiles;
    }
}
