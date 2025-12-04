<?php
namespace ALF;

use ALF\Traits\InstanceObject;

class Error
{
    use InstanceObject;

    private function abort(string $message) {
        ob_clean();
        echo $message;
        exit;
    }
}