<?php
use ALF\KeyValue;

if (!function_exists('exception_to_error')) {
    function exception_to_error($exception) {
        return [
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'message' => $exception->getMessage(),
            'class' => $exception->getClass(),
            'method' => $exception->getMethod(),
            'stack' => $exception->getStack(),
        ];
    }
}
if (!function_exists('env')) {
    function env($key, $value = null)
    {
        if ($value === null) {
            return KeyValue::get('env', $key);
        }
        if (is_array($value)) {
            KeyValue::setArray('env', $value);
        } else {
            KeyValue::set('env', $key, $value);
        }
    }
}