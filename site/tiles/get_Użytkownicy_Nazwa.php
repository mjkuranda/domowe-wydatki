<?php
    // Making connection
    include_once('../../engine/connector.php');

    $res = sqlsrv_query($con, "SELECT [Nazwa użytkownika] FROM [dbo].func_get_Użytkownicy_Nazwa('" . $_POST['Nr'] . "')");
    $nam = sqlsrv_fetch_array($res)['Nazwa'];

    // Rezultat
    echo json_encode(array(
        "Nazwa użytkownika" => $nam
    ));
?>