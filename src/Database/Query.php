<?php

namespace ALF\Database;

class Query
{
	protected $_mdl = null;
	protected $table;

	protected array $_querybuilder = [
		'select' => '*',
		'where' => [],
		'joins' => [],
		'order' => [],
		'group' => [],
		'limit' => null
	];

	public function __construct($mdl = null) {
		if ($mdl) {
			$this->_mdl = new $mdl;
		}
	}

	public function first() {
		$item = $this->limit(1)->get();
		return $item[0];
	}

	public function last() {
		$item = $this->order('id', 'DESC')->limit(1)->get();
		return $item[0];
	}

	public function get() {
		$results = $this->_get_query($this->_querybuilder);

		if ($this->_mdl !== null) {
			$list = [];
			if (!empty($results)) {
				foreach ($results AS $result) {
					$list[] = (clone $this->_mdl)->fill($result);
				}
			}
			return $list;
		}

		return $results;
    }

	public function table(string $table) {
		$this->table = $table;
	}

	public function where($key, $value, $type = '=') {
		$this->_querybuilder['where'][] = ['column' => $key, 'value' => $value, 'type' => $type];
		return $this;
	}



	public function join($table, $keyValues) {
		$this->_querybuilder['joins'][$table] = [
			'keyValues' => $keyValues
		];
		return $this;
	}

	public function select($keyValues) {
		$this->_querybuilder['select'] = [...$this->_querybuilder['select'], $keyValues];
		return $this;
	}

	public function order(string $order) {
		$this->_querybuilder['order'][] = $order;
		return $this;
	}

	public function group(mixed $group) {
		$this->_querybuilder['group'][] = $group;
		return $this;
	}

	public function limit(int $limit, int $offset = 0) {
		$this->_querybuilder['limit'] = $limit;
		$this->_querybuilder['offset'] = $offset;
		return $this;
	}


    public function save(ModelItem $model, $data) {
        // update or insert
    }

    public function insert(ModelItem $model, array $data) {

        return $model;
    }

    public function update(ModelItem $model, array $data, int $id) {
        return $model;
    }

    public function delete(int $id) {

    }

    private function _get_query(array $querybuilder) {
		$query = [];
		$params = [];

		// SELECT
		$select = '{$this->table}.*';
		if (!empty($querybuilder['select'])) {
			$select = is_array($querybuilder['select'])
				? implode(', ', $querybuilder['select'])
				: $querybuilder['select'];
		}
		$query[] = "SELECT {$select}";

		// FROM
		if ($this->_mdl->table) {
			$this->table = $this->_mdl->table;
		}
		$query[] = "FROM {$this->table}";

		// join
		if (!empty($querybuilder['joins'])) {
			foreach ($querybuilder['joins'] AS $join) {
				$query[] = "{$join['type']} JOIN {$join['table']} ON " . $join['column-left'] . ' = ' . $join['column-right'];
			}
		}

		// where
		$number = 0;
		if (!empty($querybuilder['where'])) {
			$where = [];

			foreach ($querybuilder['where'] as $condition) {
				$operator = strtoupper($condition['type'] ?? '=');
				$placeholder = ':' . preg_replace('/\W/', '_', $condition['column']) . '_' . $number;

				switch ($operator) {
					case 'LIKE':
						$where[] = "`{$condition['column']}` LIKE {$placeholder}";
						$params[str_replace(':', '', $placeholder)] = $condition['value'];
						break;

					case 'IN':
						$placeholders = [];

						foreach ($condition['value'] as $i => $value) {
							$ph = "{$placeholder}_{$i}";
							$placeholders[] = $ph;
							$params[str_replace(':', '', $ph)] = $value;
						}

						$where[] = "`{$condition['column']}` IN (" . implode(', ', $placeholders) . ")";
						break;

					case 'IS NULL':
					case 'IS NOT NULL':
						$where[] = "`{$condition['column']}` {$operator}";
						break;

					default:
						$where[] = "`{$condition['column']}` {$operator} {$placeholder}";
						$params[str_replace(':', '', $placeholder)] = $condition['value'];
				}
				$number++;
			}

			$query[] = 'WHERE ' . implode(' AND ', $where);
		}

		// group by
		if (!empty($querybuilder['group'])) {
			$query[] = 'GROUP BY ' . implode(', ', $querybuilder['group']);
		}

		// order by
		if (!empty($querybuilder['order'])) {
			$order = [];

			foreach ($querybuilder['order'] as $column => $direction) {
				$direction = strtoupper($direction);
				$direction = $direction === 'DESC' ? 'DESC' : 'ASC';

				$order[] = "{$column} {$direction}";
			}

			$query[] = 'ORDER BY ' . implode(', ', $order);
		}

		// limit
		if ($querybuilder['limit'] !== null) {
			$query[] = 'LIMIT ' . (int)$querybuilder['limit'];

			if (!empty($querybuilder['offset'])) {
				$query[] = 'OFFSET ' . (int)$querybuilder['offset'];
			}
		}

		$sql = implode(' ', $query);

		$conn = new \PDO(env('DB_TYPE') . ":host=". env('DB_HOST') . ";dbname=" . env('DB_NAME'), env('DB_USERNAME'), env('DB_PASSWORD'));
		$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		$statement = $conn->prepare($sql);
		$statement->execute($params);

		return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}