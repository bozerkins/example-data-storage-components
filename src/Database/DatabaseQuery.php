<?php

namespace DataStorageComponent\Database;

use PDO;

class DatabaseQuery
{
	protected $conncetion;

	public function __construct(PDO $connection)
	{
		$this->connection = $connection;
	}

	public function prepare($sql)
	{
		return $this->connection->prepare($sql);
	}

	public function query($sql)
	{
		return $this->connection->query($sql);
	}

	public function quote($string)
	{
		return $this->connection->quote($string);
	}
}
