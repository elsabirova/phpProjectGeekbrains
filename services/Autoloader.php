<?php
namespace app\services;

class Autoloader {
    private $fileExtension = '.php';

    /**
     * @param $className
     */
    public function loadClass($className) {
        $fileName = str_replace(['app', '\\'], [ROOT_DIR, '/'], $className);
        $fileName .= $this->fileExtension;

        if (file_exists($fileName)) {
            include $fileName;
        }
    }
}