<?php

namespace ALF\Database;
use ALF\Traits\InstanceObject;
class ModelItem
{
    use InstanceObject;

    private string $_table;

    private array $_data = [];

    private function setTable($table) {
        $this->_table = $table;
    }

    private function setData($keys, $values) {
        $this->_data = array_combine($keys, $values);
    }

    public function save() {
        // @todo: koppeling Model --> save
    }

    public function __set($key, $value) {
        $this->_data[$key] = $value;
    }

    public function __get($key) {
        return $this->_data[$key];
    }
}