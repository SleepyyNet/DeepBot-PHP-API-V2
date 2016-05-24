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
	$points = $_GET['points'];
	$bot->addPoints($user, $points);
	if ($points == '') {
		$points = $points;
	}
	
	echo 'Added ' . $user . ' ' . $points . ' ' . $pointsname;
} else {
	echo 'UnSet';
}

?>