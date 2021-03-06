<?php

// Load depedencies
require '../config/config_inc.php';
require '../vendor/autoload.php';

$bot = Deepbot\API::instance(array(
	'server' 	=> $config['server'],
	'port'		=> $config['port'],
	'secret'	=> $config['secret']
));

//Global Variable
$pointsname = $config['pointsname'];

if (isset($_GET['server']) && isset($_GET['secret'])) {
	$server = $_GET['server'];
	$secret = $_GET['secret'];

	//AddPoints

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

} else {
	//AddPoints

	if (isset($_POST['user'])) {
		$user = $_POST['user'];
		$points = $_POST['points'];
		$bot->addPoints($user, $points);
		if ($points == '') {
			$points = $points;
		}
		
		echo 'Added ' . $user . ' ' . $points . ' ' . $pointsname;
	} else {
		echo 'UnSet';
	}
}

?>