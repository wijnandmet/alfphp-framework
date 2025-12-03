<?php
namespace ALF;

use \ALF\Traits\InstanceObject;
class Request {
    use InstanceObject;

    private static $_vars = [];

    private function get($key) {
        return self::$_vars[$key];
    }

    private function set($key, $value) {
        self::$_vars[$key] = $value;
    }

    private function all() {
        return self::$_vars;
    }

    function __construct() {
        $this->set('url', trim($_SERVER['SCRIPT_NAME'], '/'));
        parse_str($_SERVER['QUERY_STRING'], $queryArr);
        $this->set('params', $queryArr);
        $this->set('method', $_SERVER['REQUEST_METHOD']);
        $this->set('domain', $_SERVER['SERVER_NAME']);
        $this->set('port', $_SERVER['SERVER_PORT']);
        $this->set('host', $_SERVER['HTTP_HOST']);
    }
}