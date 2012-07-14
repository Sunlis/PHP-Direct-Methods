<?php

class example extends DirectMethod {
	public function run(){
		return array(
			"html" => "This came from PHP",
			"more" => array("even more stuff", "that came from PHP")
		);
	}
}

?>