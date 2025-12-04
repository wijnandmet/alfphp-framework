<?php
use ALF\KeyValue;
function env($key, $value = null) {
    if ($value === null) {
        return KeyValue::get('env', $key);
    }
    if (is_array($value)) {
        KeyValue::setArray('env', $value);
    } else {
        KeyValue::set('env', $key, $value);
    }
}