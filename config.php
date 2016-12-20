<?php
$aGlobalConfig = array
(
	"appURL" => "http://virulent.pw/webtss", // Full url to WebTSS, no trailing slash or space.
	"python2.7Location" => "/usr/bin/python2.7", // Path to python 2.7, no trailing slash or space.
	"recaptcha" => array
	(
		// Get it from here: https://www.google.com/recaptcha/intro/index.html
		"enabled" => False,
		"siteKey" => "",
		"secretKey" => ""
	),
	"database" => array 
	(
		"host" => "localhost",
		"port" => "3306",
		"username" => "<DB USERNAME>",
		"password" => "<DB PASSWORD>",
		"database" => "webtss"
	)
);




// Configuration pre-processing.
// Don't touch this.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
