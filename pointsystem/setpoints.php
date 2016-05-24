<?php

if (isset($_GET['server']) && isset($_GET['secret'])) {
	$server = $_GET['server'];
	$secret = $_GET['secret'];

	// Load depedencies
	require '../config/config_inc.php';
	require '../vendor/autoload.php';

$bot = Deepbot\API::instance(array(
	'server' 	=> $config['server'],
	'port'		=> $config['port'],
	'secret'	=> $config['secret']
));

} else {
	echo 'Not Set Up';
}

//Global Variable

$pointsname = $config['pointsname'];

//SetPoints

if (isset($_GET['user'])) {
	$user = $_GET['user'];
	$newValue = $_GET['points'];
	$bot->setUserPoints($user, $newValue);
	if ($newValue == '') {
		$newValue = $points;
	}
	
	echo 'Set ' . $user . ' ' . $newValue . ' ' . $pointsname;
} else {
	echo 'UnSet';
}

?>