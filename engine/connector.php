<?php
	$serverName = "DESKTOP-I1PANLB";
	$connectionInfo = array( "Database"=>"Domowe_Wydatki", "UID"=>"sa", "PWD"=>"zaq1@WSX", "CharacterSet"=>"UTF-8");
	$con = sqlsrv_connect($serverName, $connectionInfo)
		or die ("Can't connect to Microsoft SQL Server");
?>