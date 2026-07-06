<?php

namespace ALF\Database;


class Model
{
	use \ALF\Traits\Inflator;

    public string $table = '';

    private array $columns = [];

	private array $_data = [];

    protected \ALF\Database\ModelItem $_item;

	public function __construct() {
		if ($this->table === '') {
			$table = $this->removeEndWord(get_class($this), 'Model');
			$table = $this->tableify($table);
			$table = $this->pluralize($table);
			$this->table = $table;
		}
	}



    public function hasOne(String $class, $columnname = null) {
        $mdl = new $class;

        if ($columnname === null) {
            $columnname = $mdl->getTable() . '_id';
        }

        // @TODO: haal de relatie-item op
        return null;
    }

    public function hasMany(String $class, $columnname = null) {
        $mdl = new $class;
        if ($columnname === null) {
            $columnname = $this->getTable() . '_id';
        }

        // @TODO: haal de relatie-items op
        return null;
    }

	public function fill($data) {
		return $this->_data = $data;
	}

	public function save() {
        // @todo save!
        $data = $this->_data;
		debug('save', $data);
        // do query -> execute
    }

    private function getTable() {
        return $this->table;
    }
}