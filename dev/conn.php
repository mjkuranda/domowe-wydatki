<?php
	$serverName = "DESKTOP-I1PANLB"; //serverName\instanceName
	$connectionInfo = array( "Database"=>"Domowe_Wydatki", "UID"=>"sa", "PWD"=>"zaq1@WSX");
	$con = sqlsrv_connect($serverName, $connectionInfo)
		or die ("Can't connect to Microsoft SQL Server");
?>
<?php
	function q ($c, $q) {
		$result = sqlsrv_query($c, $q) ;//or die('MSSQL error: ' . sqlsrv_errors());
		
		while ($row = sqlsrv_fetch_array($result)) {
			foreach ($row as $pole)
				echo $pole . " ";
			echo "<br>";
		}
	}
?>
<?php	
	q($con, 'SELECT * FROM osoby');
	
	sqlsrv_close($con);
?>