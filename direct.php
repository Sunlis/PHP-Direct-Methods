<?php

// make sure a method name is provided
if (!isset($_GET['method'])) {
 	echo json_encode(array("error" => "'method' GET variable must be specified."));
 	exit;
}

// magic function that looks for an un-loaded class and tries to load it
function __autoload( $className ) {	
	$names = array(
		strtolower($className),
		strtoupper($className[0]) . substr($className,1)
	);
	$suffixes = array(
		".php",
		".class.php",
		".direct.class.php"
	);
	
	$found = false;
	foreach ($names as $name) {
		foreach($suffixes as $suffix) {
			if (is_file(__DIR__ . "/classes/" . $name . $suffix)) {
				include_once(__DIR__ . "/classes/" . $name . $suffix);
				return;
			}
		}
	}
	$handle = opendir(__DIR__ . "/classes/");
	while($file = readdir($handle)){
		if($file == "." || $file == "..") continue;
		foreach($suffixes as $suffix){
			if(strtolower($className) . $suffix == strtolower($file)){
				include_once(__DIR__ . "/classes/" . $file);
				break 2; // break out so the file handle gets closed
			}
		}
	}
	closedir($handle);
}

// see if the class can be found
if (class_exists($_GET['method'], true) === false) {
	echo json_encode(array("error" => "The direct class '".$_GET['method']."' does not exist or could not be found"));
	exit;
}

// create a new instance of the direct class and call its 'run' method
$method = new $_GET['method']($_GET['method']);
$return = $method->run();
// if the method returned anything, json encode it and pass it back to Javascript
if(isset($return)){
	echo json_encode($return);
	exit;
}

?>