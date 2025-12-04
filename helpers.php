<?php
use ALF\KeyValue;

if (!function_exists('exception_to_error')) {
    function shutdown() {
        $error = error_get_last();
        if ($error) {
            ob_end_clean();
            http_response_code(404);
            echo View::load('errors/404.php')->with(['error' => $error])->render();
            exit;
        }
    }
}

if (!function_exists('exception_to_error')) {
    function exception_to_error($exception) {
        $lasterror = error_get_last();
        $trace = $exception->getTrace();
        array_unshift($trace, $lasterror);

        return [
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'message' => $exception->getMessage(),
            'trace' => $trace,
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