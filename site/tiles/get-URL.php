<?php
    $id  = (isset($_GET['id']) && !empty($_GET['id'])) ? $_GET['id'] : -1;
    $reg = (isset($_GET['register']));
    $out = array("table" => $_GET['table'], "id" => $id, "register" => $reg);
    echo json_encode($out);
?>