<?php
    if (!isset($_GET['table']) or empty($_GET['table']) or
        ($_GET['table'] != 'Osoby' and $_GET['table'] != 'Kategorie' and $_GET['table'] != 'Sklepy' and $_GET['table'] != 'Wydatki'
            and $_GET['table'] != 'Użytkownicy' and $_GET['table'] != 'Uprawnienia') or ($_COOKIE['id_user'] != -1 && !hasRule($con, "Administracja")[0])) header('location: main');
    if ((!isset($_COOKIE['id_user']) || $_COOKIE['id_user'] == -1) && $_GET['table'] != 'Użytkownicy') header('location: form?table=Użytkownicy&log');
?>

<main class="center __col2 <?php if (isset($_GET['register'])) echo '__reg__'; ?>>">
    <div class="flex-center">
        <div>
            <h1 class="flex-center"><p>Formularz tabeli</p>:&nbsp;<strong><?php echo $_GET['table']; ?></strong></h1>

            <form action="" method="POST">
                <section class="form-datas">
                    <fieldset><legend>Tabela - <?php echo $_GET['table']; ?></legend></fieldset>
                </section>
                <section class="form-bottom flex-center">
                    <button class="button-normal __col3" name="b_add" title="Dodaj rekord">Dodaj!</button>
                    <button class="button-normal __col3" name="b_clear" type="reset" title="Wyczyść formularz">Wyczyść</button>
                </section>
            </form>
        </div>
    </div>

    <section class="flex-center form-info">
        <p></p>
        <div class="hidden"><?php include_once('tiles/get-URL.php'); ?></div>
    </section>


</main>
<script src="assets/js/form.js"></script>
<?php if ($_GET['table'] == 'Uprawnienia') { ?><script src="assets/js/rules.js"></script><?php } ?>
<?php if ( isset($_GET['update']) && isset($_GET['id']) ) { ?><script src="assets/js/update.js"></script><?php } ?>
<?php if ($_GET['table'] == 'Użytkownicy' && isset($_GET['log'])) { ?><script src="assets/js/login.js"></script><?php } ?>
<?php if ($_GET['table'] == 'Użytkownicy' && isset($_GET['logout'])) {
    $res = sqlsrv_query($con, "SELECT [Nazwa użytkownika] FROM [dbo].func_get_Użytkownicy_Nazwa('" . $_COOKIE['id_user'] . "')");
    $nam = sqlsrv_fetch_array($res)['Nazwa użytkownika'];

    $query  = "EXEC proc_add_to_Logi @nr_użytkownika='" . $_COOKIE['id_user'] . "', @data='" . date('Y-m-d H:i:s') . "', @opis='Użytkownik " . $nam . " wylogował się'";
    sqlsrv_query($con, $query);
    
    setcookie('id_user', -1, time() + 24*60*60, '/');
    header('location: form?table=Użytkownicy&log');
} ?>