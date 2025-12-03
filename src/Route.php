<?php
namespace ALF;

use ALF\Traits\InstanceObject;
use ALF\App;

class Route {
    use InstanceObject;

    static $_routes = [];

    private function load() {
        $uri = Request::get('url');

        $currentRoute = self::$_routes[$uri];
        if (is_callable($currentRoute)) {
            return App::load($currentRoute);
        }
    }

    private function get($uri, $controller)
    {
        self::$_routes[trim($uri, '/')] = $controller;
    }

    private function post($uri, $controller)
    {

    }

    private function resource($uri, $controller, $paramNames)
    {

    }
}