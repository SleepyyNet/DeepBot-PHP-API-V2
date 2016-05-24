<?php

if (isset($_GET['number']) && !empty($_GET['number'])) {
	$number = $_GET['number'];
	if (is_numeric($number) && $number > 0) {
		if (floor(floatval($number)) == floatval($number)) {
			echo "true";
		} else {
			echo "false";
		}
	} else {
		echo "false";
	}
}

?>