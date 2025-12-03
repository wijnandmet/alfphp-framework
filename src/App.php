<?php
namespace ALF;

use ALF\Traits\InstanceObject;
class App {
    use InstanceObject;
    private function load($method) {
        if($method instanceof \Closure) {
            $rf = new \ReflectionFunction($method);
            foreach($rf->getParameters() AS $parameter) {
                $name = $parameter->getName();
                if ($parameter->hasType()) {
                    $type = $parameter->getType()->getName();
                }
                $defaultValue = null;
                if ($parameter->isDefaultValueAvailable()) {
                    $defaultValue = $parameter->getDefaultValue();
                }



                echo '<hr>';
                var_export($parameter->getAttributes());
            };
        } else if (is_callable($method)) {
            var_export($method);
            echo 'objct!!!!! (App.php regel 9)';
            //$reflectionClass = new ReflectionClass('MyClass');
            //echo $reflectionClass->getName(); // Outputs "MyClass"
            // $reflectionMethod = $reflectionClass->getMethod('add');
//            $object = $reflectionClass->newInstance();
//            $result = $reflectionMethod->invoke($object, 16, 26);
        }


        // if
        echo 'a';
    }
}