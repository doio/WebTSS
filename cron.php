<?php
	require 'config.php';
	require 'functions.php';

	if(!$aGlobalConfig['cron']['enableWebAccess'])
		die("The website administrator has disabled cron triggers through the URL.");
	
	cronPrint('WebTSS cron running..');

	$webTSSRoot = realpath(dirname(__FILE__));
	$mysqli = new mysqli($aGlobalConfig['database']['host'], $aGlobalConfig['database']['username'], $aGlobalConfig['database']['password'], $aGlobalConfig['database']['database']);
	$tssPermissions = substr(sprintf('%o', fileperms($webTSSRoot.'/tss')), -4);
	
	if(!is_dir($webTSSRoot.'/tss'))
		die('Please create the directory "'.$webTSSRoot.'/tss'.'"..');

	if(!is_writable($webTSSRoot.'/tss')) 
		die('Can\'t write to "'.$webTSSRoot.'/tss"..');
	
	if(!is_readable($webTSSRoot.'/tss'))
		die('Can\'t read "'.$webTSSRoot.'/tss"..');
		
	if(!is_dir($webTSSRoot.'/bins'))
		die('Please create the directory "'.$webTSSRoot.'/bins"..');
		
	if(!is_readable($webTSSRoot.'/bins'))
		die('Can\'t read "'.$webTSSRoot.'/bins"..');

	if (mysqli_connect_errno())
		die('Can\'t connect to the database..');

	if ($stmt = $mysqli->prepare("SELECT ecid, platform FROM devices")) {

		/* execute statement */
		$stmt->execute();

		/* bind result variables */
		$stmt->bind_result($ecid, $platform);

		/* fetch values */
		while ($stmt->fetch()) {
			cronPrint("Working on $ecid ($platform)..");

			$command = $aGlobalConfig['cron']['python2.7Location'].' '.$webTSSRoot.'/bins/savethemblobs.py '.hexdec($ecid).' '.$platform.' --skip-cydia --skip-ifaith --save-dir '.$webTSSRoot.'/tss/'.hexdec($ecid);
		
			if(!is_dir($webTSSRoot.'/tss/'.hexdec($ecid))) {
				cronPrint("Creating \"".$webTSSRoot.'/tss/'.hexdec($ecid)."\"..");
				mkdir($webTSSRoot.'/tss/'.hexdec($ecid));
			}
		
			if(!is_readable($webTSSRoot.'/tss/'.hexdec($ecid)) || !is_writable($webTSSRoot.'/tss/'.hexdec($ecid))) {
				cronPrint('Can\'t read and/or write to "'.$webTSSRoot.'/tss/'.hexdec($ecid).'"..');
			} else {
				cronPrint("Running \"$command\"..");
				shell_exec($command);
			}
		}

		/* close statement */
		$stmt->close();
	}

	/* close connection */
	$mysqli->close();
	cronPrint('Cron finished.'); 
?>
