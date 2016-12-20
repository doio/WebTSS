<?php
	try {
		require 'config.php';
		
		if(empty($_POST['ecid']))
			throw new Exception('Please provide an ECID.');
		if(empty($_POST['platform']))
			throw new Exception('Please provide a platform.');
		if(!ctype_xdigit($_POST['ecid']))
			throw new Exception('Invalid ECID.');
		
		if(ctype_digit($_POST['ecid'])) { // Client provided a non-hex ECID. Convert it for them.
			$ecid = strtoupper(dechex($_POST['ecid']));
		} elseif(ctype_xdigit($_POST['ecid'])) { // Client provided a hex ECID, just assign the variable.
			$ecid = $_POST['ecid'];
		} else {
			throw new Exception('Invalid ECID.');
		}

		$conn = new mysqli($aGlobalConfig['database']['host'], $aGlobalConfig['database']['username'], $aGlobalConfig['database']['password'], $aGlobalConfig['database']['database']);

		if (mysqli_connect_errno())
			throw new Exception('Could not connect to database.');
			
		$stmt = $conn->prepare("INSERT INTO devices (ecid, platform) VALUES (?, ?)"); // Pretty sure PDO is secure enough for this. If not, would you mind contributing a fix? :)
		$stmt->bind_param("ss", $ecid, $_POST['platform']); 
		$stmt->execute();
		$stmt->close();
		$conn->close();

		header('Location: '.str_replace("/".basename(__FILE__), "", $_SERVER['PHP_SELF']).'/tss/'.hexdec($ecid));
	} catch (Exception $e) {
		header("Location: index.php?e=".urlencode($e->getMessage()));
	}
?>