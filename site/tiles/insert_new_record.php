<?php
    include_once('../../engine/connector.php');

    $res = null;
    switch ($_POST['table']) {
        case 'Osoby':
            $res = sqlsrv_query($con, 'EXEC proc_add_to_'.$_POST['table'].' @imie='.$_POST['form']['Imię'].', @nazwisko='.$_POST['form']['Nazwisko']);
        break;

        case 'Kategorie':
            $res = sqlsrv_query($con, 'EXEC proc_add_to_'.$_POST['table'].' @nazwa_kategorii='.$_POST['form']['Nazwa kategorii']);
        break;

        case 'Sklepy':
            $res = sqlsrv_query($con, "EXEC proc_add_to_".$_POST['table']." @nazwa='".$_POST['form']['Nazwa']."', @adres='".$_POST['form']['Adres']."', @kod_pocztowy='".$_POST['form']['Kod pocztowy']."', @miasto='".$_POST['form']['Miasto']."', @telefon='".$_POST['form']['Telefon']."'");
        break;

        case 'Wydatki':
            $res = sqlsrv_query($con, "EXEC proc_add_to_".$_POST['table']." '".$_POST['form']['Kategoria']."', '".$_POST['form']['Osoba']."', '".$_POST['form']['Sklep']."', '".$_POST['form']['Data']."', '".$_POST['form']['Kwota']."', ".$_POST['form']['Opis']);
        break;

        case 'Użytkownicy':
            $res = sqlsrv_query($con, 'EXEC proc_add_to_'.$_POST['table'].' @nazwa='.$_POST['form']['Nazwa użytkownika'].', @haslo='.$_POST['form']['Hasło']);
        break;

        case 'Uprawnienia':
            $res = sqlsrv_query($con, 'EXEC proc_add_to_'.$_POST['table'].' '.$_POST['form']['Użytkownik'].', '.$_POST['form']['Zasada']);
        break;
    }

    // Add log
    $res = sqlsrv_query($con, "SELECT [Nazwa użytkownika] FROM [dbo].func_get_Użytkownicy_Nazwa('" . $_POST['user']['id'] . "')");
    $nam = sqlsrv_fetch_array($res)['Nazwa użytkownika'];

    $query  = "EXEC proc_add_to_Logi @nr_użytkownika='" . $_POST['user']['id'] . "', @data='" . date('Y-m-d H:i:s') . "', @opis='Użytkownik " . $nam . " dodał nowy rekord do tabeli: " . $_POST['table'] . "'";
    sqlsrv_query($con, $query);



    $err = (sqlsrv_errors()) ? true : false;

    echo json_encode(
        array(
            'table' => $_POST['table'],
            'form' => $_POST['form'],
            'error' => $err,
            'errs' => sqlsrv_errors()
        )
    );
?>