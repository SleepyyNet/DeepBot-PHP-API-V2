<?php

if (isset($_GET['server']) && isset($_GET['secret'])) {
	$server = $_GET['server'];
	$secret = $_GET['secret'];
	// Load depedencies

	require __DIR__ . '/config/config_inc.php';
	require dirname(__FILE__) . '/vendor/autoload.php';

$bot = Deepbot\API::instance(array(
	'server' 	=> $config['server'],
	'port'		=> $config['port'],
	'secret'	=> $config['secret']
));

} else {
	echo 'Not Set Up';
}

if (isset($_GET['user'])) {
	$user = $_GET['user'];
	$vip = $_GET['vip'];
	$days = $_GET['days'];
	$bot->setUserVip($user, $vip, $days);
	if ($vip == '1') {
		$vip = 'Bronze';
	} else if ($vip == '2') {
		$vip = 'Silver';
	} else if ($vip == '3') {
		$vip = 'Gold';
	} else {
		$vip = 'None';
	}
	echo 'Set ' . $user . ' ' . $vip . ' ' . $days;
} else {
	echo 'UnSet';
}

?>