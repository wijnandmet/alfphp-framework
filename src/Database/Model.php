<?php

namespace ALF\Database;

class Model
{
    private string $table = '';

    private array $columns = [];

    protected \ALF\Database\ModelItem $_item;

    protected array $_querybuilder = [
        'select' => '*',
        'where' => [],
        'joins' => [],
        'order' => [],
        'group' => [],
        'limit' => null
    ];

    protected function hasOne(String $class, $columnname = null) {
        $mdl = new $class;

        if ($columnname === null) {
            $columnname = $mdl->getTable() . '_id';
        }

        // @TODO: haal de relatie-item op
        return null;
    }

    protected function hasMany(String $class, $columnname = null) {
        $mdl = new $class;
        if ($columnname === null) {
            $columnname = $this->getTable() . '_id';
        }

        // @TODO: haal de relatie-items op
        return null;
    }

    private function get() {
        // @TODO: return all() --> first
        $item = $this->limit(1)->all();
        return $item[0];
    }

    private function all() {

        // @TODO: return all
    }

    private function where($key, $value, $type = '=') {
        // @TODO: return $this and add where
        $this->_querybuilder['where'][$key] = ['value' => $value, 'type' => $type];
        return $this;
    }



    private function join($table, $keyValues) {
        $this->_querybuilder['joins'][$table] = [
            'keyValues' => $keyValues
        ];
        return $this;
    }

    private function select($keyValues) {
        $this->_querybuilder['select'] = [...$this->_querybuilder['select'], $keyValues];
        return $this;
    }

    private function order(string $order) {
        $this->_querybuilder['order'][] = $order;
        return $this;
    }

    private function group(mixed $group) {
        $this->_querybuilder['group'][] = $group;
        return $this;
    }

    private function limit(int $limit, int $offset = 0) {
        $this->_querybuilder['limit'] = $limit;
        $this->_querybuilder['offset'] = $offset;
        return $this;
    }

    private function save() {
        // @todo save!
        $data = $this->_item->getData();
        // do query -> execute
    }

    private function getTable() {
        return $this->table;
    }
}