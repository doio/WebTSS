<?php
	try {
		require 'config.php';
		
		if(empty($_POST['ecid']))
			throw new Exception('Please provide an ECID.');
		if(!ctype_xdigit($_POST['ecid']))
			throw new Exception('Invalid ECID.');

		if(ctype_digit($_POST['ecid'])) { // Client provided a non-hex ECID. Convert it for them.
			$ecid = strtoupper(dechex($_POST['ecid']));
		} elseif(ctype_xdigit($_POST['ecid'])) { // Client provided a hex ECID, just assign the variable.
			$ecid = strtoupper($_POST['ecid']);
		} else {
			throw new Exception('Invalid ECID.');
		}

		$conn = new mysqli($aGlobalConfig['database']['host'], $aGlobalConfig['database']['username'], $aGlobalConfig['database']['password'], $aGlobalConfig['database']['database']);

		
		if (mysqli_connect_errno())
			throw new Exception('Could not connect to database.');
		
		try {	
			if(!$stmt = $conn->prepare("SELECT ecid FROM devices WHERE ecid = ?")) // Pretty sure PDO is secure enough for this. If not, would you mind contributing a fix? :)
				throw new Exception('First repared statement failed.');
			$stmt->bind_param("s", $ecid); 
			
			if(!$stmt->execute())
				throw new Exception('First execution failed.');
			$stmt->bind_result($ecidFromQuery);
			
			$stmt->fetch();
			
			if($ecid == $ecidFromQuery) {
				header('Location: '.str_replace("/".basename(__FILE__), "", $_SERVER['PHP_SELF']).'/tss/'.hexdec($ecid));
			} else {
				throw new Exception('This ECID is not in our database.');
			}
			
			$stmt->close();
			$conn->close();
		} catch (PDOException $e) {
			throw new Exception('SQL Error');
		}
	} catch (Exception $e) {
		header("Location: index.php?e=".urlencode($e->getMessage()));
	}
?>