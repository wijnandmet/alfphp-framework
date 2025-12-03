<?php
namespace ALF;

use ALF\App;
use ALF\Traits\InstanceObject;

class Route {
    use InstanceObject;

    static $_routes = [];

    private function load() {
        $uri = Request::get('url');

        $currentRoute = self::$_routes[$uri];
        if (is_array($currentRoute)) {
            return App::load($currentRoute);
        }
    }

    private function get($uri, $controller, $method= null)
    {
        if ($method) {
            $controller = [$controller, $method];
        }
        self::$_routes[trim($uri, '/')] = $controller;
    }

    private function post($uri, $controller)
    {

    }

    private function resource($uri, $controller, $paramNames)
    {

    }
}