<?php
namespace ALF;

use ALF\Traits\InstanceObject;

class Languages {

    use InstanceObject;
    private function load() {
        $dir = new \DirectoryIterator($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'App' . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR . env('LANG'));
        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
                $file = $fileinfo->getPath() . DIRECTORY_SEPARATOR . $fileinfo->getFilename();
                $arr = include($file);

                KeyValue::setArray('lang', array_flatten($arr));
            }
        }
    }
}