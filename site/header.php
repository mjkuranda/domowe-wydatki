<?php $logged = false; ?>
<?php
    // If someone has a icons
    function hasRule ($con, $rule) {
        $q = "SELECT dbo.func_check_user_rule('" . $_COOKIE['id_user'] . "', dbo.func_get_Zasady_Nr('" . $rule . "'))";
        $r = sqlsrv_query($con, $q);
        return sqlsrv_fetch_array($r);
    }
?>
<header class="__col1">
    <div class="center flex-around">
        <section class="sec-user flex-center">
            <div class="sec-user-dignity flex-center">
                <svg viewBox="-42 0 512 512.002" xmlns="http://www.w3.org/2000/svg">
                    <path d="m210.351562 246.632812c33.882813 0 63.222657-12.152343 87.195313-36.128906 23.972656-23.972656 36.125-53.304687 36.125-87.191406 0-33.875-12.152344-63.210938-36.128906-87.191406-23.976563-23.96875-53.3125-36.121094-87.191407-36.121094-33.886718 0-63.21875 12.152344-87.191406 36.125s-36.128906 53.308594-36.128906 87.1875c0 33.886719 12.15625 63.222656 36.132812 87.195312 23.976563 23.96875 53.3125 36.125 87.1875 36.125zm0 0"></path><path d="m426.128906 393.703125c-.691406-9.976563-2.089844-20.859375-4.148437-32.351563-2.078125-11.578124-4.753907-22.523437-7.957031-32.527343-3.308594-10.339844-7.808594-20.550781-13.371094-30.335938-5.773438-10.15625-12.554688-19-20.164063-26.277343-7.957031-7.613282-17.699219-13.734376-28.964843-18.199219-11.226563-4.441407-23.667969-6.691407-36.976563-6.691407-5.226563 0-10.28125 2.144532-20.042969 8.5-6.007812 3.917969-13.035156 8.449219-20.878906 13.460938-6.707031 4.273438-15.792969 8.277344-27.015625 11.902344-10.949219 3.542968-22.066406 5.339844-33.039063 5.339844-10.972656 0-22.085937-1.796876-33.046874-5.339844-11.210938-3.621094-20.296876-7.625-26.996094-11.898438-7.769532-4.964844-14.800782-9.496094-20.898438-13.46875-9.75-6.355468-14.808594-8.5-20.035156-8.5-13.3125 0-25.75 2.253906-36.972656 6.699219-11.257813 4.457031-21.003906 10.578125-28.96875 18.199219-7.605469 7.28125-14.390625 16.121094-20.15625 26.273437-5.558594 9.785157-10.058594 19.992188-13.371094 30.339844-3.199219 10.003906-5.875 20.945313-7.953125 32.523437-2.058594 11.476563-3.457031 22.363282-4.148437 32.363282-.679688 9.796875-1.023438 19.964844-1.023438 30.234375 0 26.726562 8.496094 48.363281 25.25 64.320312 16.546875 15.746094 38.441406 23.734375 65.066406 23.734375h246.53125c26.625 0 48.511719-7.984375 65.0625-23.734375 16.757813-15.945312 25.253906-37.585937 25.253906-64.324219-.003906-10.316406-.351562-20.492187-1.035156-30.242187zm0 0"></path>
                </svg>
                <strong>
                    <?php
                        if (!isset($_COOKIE['id_user']) || $_COOKIE['id_user'] == -1) echo 'Witaj, użytkowniku!';
                        else {
                            // Otrzymaj imię użytkownika
                            $res_name = sqlsrv_query($con, "SELECT [Nazwa użytkownika] FROM func_get_Użytkownicy_Nazwa(" . $_COOKIE['id_user'] . ")");
                            $row_name = sqlsrv_fetch_array($res_name);

                            echo 'Witaj, ' . $row_name['Nazwa użytkownika'] . '!';
                            $logged = true;
                        }
                    ?>
                </strong>
            </div>
            &nbsp;
            <div class="sec-user-nav">
                <?php if (!isset($_COOKIE['id_user']) || $_COOKIE['id_user'] == -1) { ?>
                    <a href="form?table=Użytkownicy&log">Zaloguj się!</a> lub <a href="form?table=Użytkownicy&register">Zarejestruj!</a>
                <?php } ?>
            </div>
        </section>
        <nav class="flex-center">
            <div><p>Strona Główna</p></div>
            <?php if (hasRule($con, 'Dodawanie')) { ?>
            <div>
                <p>Formularze</p>
                <ul class="hidden">
                    <a href="form?table=Osoby"><li>Osoby</li></a>
                    <a href="form?table=Sklepy"><li>Sklepy</li></a>
                    <a href="form?table=Kategorie"><li>Kategorie</li></a>
                    <a href="form?table=Wydatki"><li>Wydatki</li></a>
                    <?php if ($_COOKIE['id_user'] == 0) { ?><a href="form?table=Uprawnienia"><li>Uprawnienia</li></a><?php } ?>
                </ul>
            </div>
            <?php } ?>
            <?php if (hasRule($con, 'Wyświetlanie')) { ?>
            <div>
                <p>Raporty</p>
                <ul class="hidden">
                    <a href="report?table=Osoby"><li>Osoby</li></a>
                    <a href="report?table=Sklepy"><li>Sklepy</li></a>
                    <a href="report?table=Kategorie"><li>Kategorie</li></a>
                    <a href="report?table=Wydatki"><li>Wydatki</li></a>
                </ul>
            </div>
            <?php } ?>
            <?php if ($logged) { ?>
                <div>
                <p>Administracja</p>
                <ul class="hidden">
                    <?php if ($_COOKIE['id_user'] == 0) { ?><a href="report?table=Użytkownicy"><li>Użytkownicy</li></a><?php } ?>
                    <?php if (hasRule($con, 'Wyświetlanie')) { ?>
                        <a href="report?table=Uprawnienia"><li>Zobacz uprawnienia</li></a>
                        <a href="report?table=Zasady"><li>Zobacz zasady</li></a>
                        <a href="report?table=Logi"><li>Zobacz logi</li></a>
                    <?php } ?>
                    <a href="form?table=Użytkownicy&logout"><li>Wyloguj</li></a>
                </ul>
            </div>
            <?php } ?>
        </nav>
    </div>
</header>