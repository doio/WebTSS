<?php
	
	// Cron functions
	function cronPrint($message) {	
		if (php_sapi_name() == "cli") {
			echo $message."\n";
		} else {
			echo $message."<br/>";
		}
	}