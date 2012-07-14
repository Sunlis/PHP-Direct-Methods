<?php

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
			if($lowerClassName . $suffix == strtolower($file)){
				include_once(__DIR__ . "/classes/" . $file);
				break 2; // break out so the file handle gets closed
			}
		}
	}
	closedir($handle);
}

?>