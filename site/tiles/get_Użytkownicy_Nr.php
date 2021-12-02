<?php
    // Making connection
    include_once('../../engine/connector.php');

    $res = sqlsrv_query($con, "SELECT [Nr] FROM [dbo].func_get_Użytkownicy_Nr('" . $_POST['Nazwa'] . "')");
    $id = sqlsrv_fetch_array($res)['Nr'];

    // Rezultat
    echo json_encode(array(
        "Nr" => $id
    ));
?>