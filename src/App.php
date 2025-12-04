<?php

namespace ALF;

use ALF\Traits\InstanceObject;

class App
{
    use InstanceObject;

    private function load($method) {
        // anonymous method
        if ($method instanceof \Closure) {
            $rf = new \ReflectionFunction($method);
            $parameters = $this->getParametersFromMethod($rf);

            return call_user_func_array($method, $parameters);
        } else if (is_array($method)) {
            $reflectionClass = new \ReflectionClass($method[0]);
            $rf = $reflectionClass->getMethod($method[1]);
            $parameters = $this->getParametersFromMethod($rf);

            return call_user_func_array([new $method[0], $method[1]], $parameters);
        } else {
            return 'a';
        }
    }

    private function getParametersFromMethod(\ReflectionFunction|\ReflectionMethod $rf)
    {
        $parameters = [];
        foreach ($rf->getParameters() as $parameter) {
            $name = $parameter->getName();
            $type = $parameter->getType();
            if ($parameter->hasType()) {
                $type = $parameter->getType()->getName();
            }

            $defaultValue = null;
            if ($parameter->isDefaultValueAvailable()) {
                $defaultValue = $parameter->getDefaultValue();
            }

            if ($type !== null && class_exists($type)) {
                $value = new $type();
            } else {
                $value = $defaultValue || null;
            }

            $parameters[$name] = $value;
        }
        return $parameters;
    }
}