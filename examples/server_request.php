<?php

use DataStorageComponent\WebApi\Client\Client;

require_once "../vendor/autoload.php";

// set client

$client = new Client();
$client->configure(array(
	'url' => 'http://' . $_SERVER['HTTP_HOST'] . str_replace('server_request.php', 'server.php', $_SERVER['SCRIPT_NAME']),
));

$response = $client->execute('test', array(
	'test2' => 'my test'
));

echo $response;
