<?php
namespace ALF;

class KeyValue {

    private static array $_vars = [];

    public static function get($category, $key): mixed {
        return self::$_vars[$category][$key] ?? null;
    }

    public static function set($category, $key, $value): void {
        if (!isSet(self::$_vars[$category])) {
            self::$_vars[$category] = [];
        }
        self::$_vars[$category][$key] = $value;
    }

    public static function setArray($category, $array): void {
        if (!isSet(self::$_vars[$category])) {
            self::$_vars[$category] = [];
        }
        self::$_vars[$category] = [...self::$_vars[$category], ...$array];
    }

    public static function has($category, $key): bool {
        return isset(self::$_vars[$category][$key]);
    }
}