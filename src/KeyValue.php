<?php
namespace ALF;

class KeyValue {

    private static array $_vars = [];

    public static function get($category, $key): mixed {
        return self::$_vars[$category][$key] ?? null;
    }

    public static function set($category, $key, $value): void {
        if (self::$_vars[$category]) {
            self::$_vars[$category] = [];
        }
        self::$_vars[$category][$key] = $value;
    }

    public static function setArray($category, $array): void {
        if (self::$_vars[$category]) {
            self::$_vars[$category] = [];
        }
        self::$_vars[$category] = [...self::$_vars[$category], ...$array];
    }
}