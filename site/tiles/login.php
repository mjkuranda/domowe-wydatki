<?php
    // Making connection
    include_once('../../engine/connector.php');

    $query = "
        SELECT  *
        FROM    view_select_all_Użytkownicy
        WHERE   [Nazwa użytkownika] = '" . $_POST['Nazwa'] . "' AND
                [Hasło] = '" . md5($_POST['Hasło']) . "'
    ";
    $res = sqlsrv_query($con, $query, array(), array("Scrollable" => 'keyset'));
    $num = sqlsrv_num_rows($res);

    $logged = ($num > 0);

    // Dodaj log
    if ($logged) {
        $row    = sqlsrv_fetch_array($res);
        $query  = "EXEC proc_add_to_Logi @nr_użytkownika='" . $row['Nr'] . "', @data='" . date('Y-m-d H:i:s') . "', @opis='Użytkownik " . $row['Nazwa użytkownika'] . " zalogował się'";
        sqlsrv_query($con, $query);
    }

    echo json_encode(array(
        "logged" => $logged
    ));
?>