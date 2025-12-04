<?php
namespace ALF;

use ALF\App;
use ALF\Traits\InstanceObject;

class Route {
    use InstanceObject;

    static $_routes = [];

    private function load() {
        $uri = '/' . Request::get('url');
        if ($route = self::$_routes[$uri]) {
            return App::load(self::$_routes[$uri]);
        }

        $resource_path = rtrim($_SERVER['DOCUMENT_ROOT'],'/') . '/App/resources/' . trim($uri, '/');
        if (file_exists($resource_path)) {
            ob_clean();
            $content = file_get_contents($resource_path);
            echo $content;
            exit;
        }

        throw new \Exception('Route not found: ' . $uri);
    }

    private function get($uri, $controller, $method= null)
    {
        if ($method) {
            $controller = [$controller, $method];
        }
        self::$_routes['/' . trim($uri, '/')] = $controller;
    }

    private function post($uri, $controller)
    {

    }

    private function resource($uri, $controller, $paramNames)
    {

    }
}