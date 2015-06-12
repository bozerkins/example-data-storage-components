<?php

use DataStorageComponent\Database\DatabaseProvider;

require_once "../vendor/autoload.php";


$host = 'localhost';
$dbname = 'test_db';
$user = 'root';
$password = '';

DatabaseProvider::initialize($host, $dbname, $user, $password);
$database = DatabaseProvider::make();
$records = $database->query("SELECT * FROM test_table LIMIT 15")->fetchAll();

echo '<pre>';
print_r($records);
