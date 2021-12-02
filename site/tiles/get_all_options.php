<?php
    $reg   = false; if (isset($_POST['reg'])) $reg = $_POST['reg'];
    $table = $_POST['table']; echo '   Reg:'.empty($reg).'   '.$table; if($table == 'Zasady') $table = ''; if ($reg != "false" && !empty($reg)) $table = 'Nousers';
    $user  = ''; if (isset($_POST['user'])) $user = $_POST['user'];

    // Połączenie
    include_once('../../engine/connector.php');
    $query = 'SELECT * FROM func_get_all_'.$table.'('.$user.')';
    $res = sqlsrv_query($con, $query);

    echo $query;

    while ($row = sqlsrv_fetch_array($res)) {
        echo '<option id="'.$row['Nr'].'">'.$row[1].'</option>';
    }
?>