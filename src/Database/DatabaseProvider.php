<?php

namespace DataStorageComponent\Database;

use PDO;

class DatabaseProvider
{
	protected static $DBH = null;

	public static function initialize($host, $dbname, $user, $pass)
	{
		self::setConnection(new PDO("mysql:host=$host;dbname=$dbname", $user, $pass));
	}

	public static function make()
	{
		return new DatabaseQuery(self::getConnection());
	}

	protected static function getConnection()
	{
		if (!self::$DBH) {
			throw new \ErrorException('No connection established');
		}
		return self::$DBH;
	}

	protected static function setConnection(PDO $DBH)
	{
		self::$DBH = $DBH;
		self::$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		self::$DBH->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		self::$DBH->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
	}
}
