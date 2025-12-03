<?php
namespace ALF\Traits;
trait InstanceObject
{

    static $_instanceValue;

    private static function _instanceObject()
    {
        if (self::$_instanceValue === null) {
            self::$_instanceValue = new self();
        }
        return self::$_instanceValue;
    }

    public static function __callStatic($name, $arguments)
    {
        if (method_exists(self::class, $name)) {
            return self::_instanceObject()->$name(...$arguments);
        }
        return null;
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this, $name)) {
            return $this->$name(...$arguments);
        }
        return null;
    }
}