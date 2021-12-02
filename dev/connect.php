<?php
	$serverName = "STACJA_SQL"; //serverName\instanceName
	$connectionInfo = array( "Database"=>"Northwind", "UID"=>"sa", "PWD"=>"zaq1@WSX");
	$conn = sqlsrv_connect($serverName, $connectionInfo);

	if($conn) {
		echo "Connection established.<br />";
	} else {
		echo "Connection could not be established.<br />";
		die (print_r( sqlsrv_errors(), true));
	}
?>