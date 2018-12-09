<?php
namespace app\services;
class Autoloader {
    public function loadClass($classname) {
        $classname = str_replace("app", '', $classname);
        $classname = str_replace("\\", '/', $classname);

        $filename = ROOT_DIR . "{$classname}.php";
        if (file_exists($filename)) {
            include $filename;
        }
    }
}