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

if (!function_exists('lang')) {
    function lang($key, $defaultValue)
    {
        if (KeyValue::has('lang', $key)) {
            return KeyValue::get('lang', $key);
        }

        return $defaultValue;
    }
}

if (!function_exists('array_flatten')) {
    function array_flatten($array, $prefix = '')
    {
        $result = array();

        foreach ($array as $key => $value) {
            $new_key = $prefix . (empty($prefix) ? '' : '.') . $key;

            if (is_array($value)) {
                $result = array_merge($result, array_flatten($value, $new_key));
            } else {
                $result[$new_key] = $value;
            }
        }

        return $result;
    }
}

if (!function_exists('debug')) {
    function debug($value)
    {
        echo '<pre>';
        var_export($value);
        echo '</pre>';
        exit;
    }
}

