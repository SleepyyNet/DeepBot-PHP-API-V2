<?php

// Load depedencies
require __DIR__ . '/config/config_inc.php';
require dirname(__FILE__) . '/vendor/autoload.php';

$bot = Deepbot\API::instance(array(
	'server' 	=> $config['server'],
	'port'		=> $config['port'],
	'secret'	=> $config['secret']
));


header('Content-Type: application/json');

echo json_encode($bot->getUsers());
?>