<?php
    /*
        Plik odpowiada za zarządzanie stroną podczas jej ładowania.
        Chodzi o zarządzanie URL'em.
        Również czyści bufor.
    */

    // Init
    ob_start();
    ob_clean();
    session_start();

    // Podprogram sprawdza, czy istnieje zmienna 'sub'
    if (!isset($_GET['sub'])) $_GET['sub'] = 'main';

    // Pliki cookies
    if (!isset($_COOKIE['id_palette'])) setcookie('id_palette', '0', time() + 60*60*24, '/');
?>