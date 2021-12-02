<?php
    include_once('../../engine/connector.php');

    $x = "";
    if (isset($_POST['id2']) && $_POST['id2'] != 'undefined') $x = ", @id2='".$_POST['id2']."'"; 
    $res = sqlsrv_query($con, "EXEC proc_delete_row @table='".$_POST['table']."', @id='".$_POST['id']."'".$x);
    
    // // Add log
    $res = sqlsrv_query($con, "SELECT * FROM [dbo].[func_get_Użytkownicy_Nazwa]('" . $_COOKIE['id_user'] . "')");
    $nam = sqlsrv_fetch_array($res)['Nazwa użytkownika'];

    $query  = "EXEC proc_add_to_Logi @nr_użytkownika='" . $_COOKIE['id_user'] . "', @data='" . date('Y-m-d H:i:s') . "', @opis='Użytkownik " . $nam . " usunął rekord w tabeli: " . $_POST['table'] . "'";
    sqlsrv_query($con, $query);



    $err = (sqlsrv_errors()) ? true : false;

    echo json_encode(
        array(
            'error' => $err
        )
    );
?>