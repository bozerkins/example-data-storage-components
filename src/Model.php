<?php

namespace DataStorageComponent;

use DataStorageComponent\Database\DatabaseProvider;

class Model
{
	protected $database;
	protected $table;
	protected $primaryKey = array();

	public function __construct()
	{
		$this->database = DatabaseProvider::make();
	}

	public function getTable()
	{
		return $this->table;
	}

	public function getConnection()
	{
		return $this->database;
	}

	public function exists($primaryKey)
	{
		$where = array();
		foreach($this->primaryKey as $key) {
			$where[] = $key . ' = ' . $this->quote($primaryKey[$key]);
		}
		$record = $this->database->query("SELECT COUNT(*) as cnt FROM {$this->table} WHERE " . implode(' AND ', $where))->fetchOne();
		return $record && $record['cnt'] > 0;
	}


	public function selectQuery($primaryKey)
	{
		$where = array();
		foreach($this->primaryKey as $key) {
			$where[] = $key . ' = ' . $this->quote($primaryKey[$key]);
		}
		return $this->database->query("SELECT * FROM {$this->table} WHERE " . implode(' AND ', $where))->fetchOne();
	}

	public function createQuery(array $record, $ignore = false)
	{
		$fields = implode("`, `", array_keys($record));
		$values = implode(", ", $this->quote($record));

		$igoneSql = '';
		if ($ignore) {
			$ignoreSql = ' IGNORE ';
		}
		return $this->database->query("INSERT {$ignoreSql} INTO `{$this->table}` (`{$fields}`) VALUES ({$values})");
	}

	protected function quote($data)
	{
		if (is_array($data)) {
			foreach ($data as &$i) {
				$i = $this->quote($i);
			}
			return $data;
		}
		if (is_null($data)) {
			$data = 'NULL';
		} elseif (is_int($data)) {
			$data = intval($data);
		} elseif (is_string($data)) {
			$data = $this->database->quote($data);
		}
		return $data;
	}
}
