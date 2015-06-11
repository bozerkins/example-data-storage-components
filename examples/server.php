<?php

use DataStorageComponent\WebApi\Server\Server;

require_once "../vendor/autoload.php";

// set request

if (!array_key_exists('action', $_REQUEST)) {
	$_REQUEST['action'] = 'test';
}
if (!array_key_exists('params', $_REQUEST)) {
	$_REQUEST['params'] = array(
		'pram pam pam' => 'my params string',
	);
}

// set server

$server = new Server();
$server->configure(array(
	'action_key' => 'action',
	'params_key' => 'params'
));
$server->register('test', function($params) {
	return $params;
});
$response = $server->execute();

echo json_encode($response);
