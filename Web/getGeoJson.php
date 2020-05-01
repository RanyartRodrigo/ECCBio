<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	$file = $_REQUEST['file'];
	$result = file_get_contents($file);
	//$array = json_decode($result, true);
	//echo json_encode($array);
	echo json_encode($result);
?>
