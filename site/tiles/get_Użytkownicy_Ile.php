<?php
    // Making connection
    include_once('../../engine/connector.php');

    $res = sqlsrv_query($con, "SELECT [Nr] FROM [dbo].func_get_Użytkownicy_Nr('" . $_POST['Nazwa'] . "')");
    $num = sqlsrv_fetch_array($res);

    // Rezultat
    echo json_encode(array(
        "e" => sqlsrv_errors(),
        "count" => $num,
        "x" => $_POST['Nazwa']
    ));
?>