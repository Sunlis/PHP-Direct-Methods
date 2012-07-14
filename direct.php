<?php

if (!isset($_GET['method'])) {
 	echo json_encode(array("error" => "'method' GET variable must be specified."));
 	exit;
}

include_once("autoloader.php");

$method = new $_GET['method']($_GET['method']);
$return = $method->run();
if(isset($return)){
	echo json_encode($return);
	exit;
}

?>