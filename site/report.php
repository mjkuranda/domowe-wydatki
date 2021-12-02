<?php $error = false; ?>
<main class="center __col2">
    <div class="flex-center">
    <?php
        if (!isset($_GET['table']) || (
            $_GET['table'] != 'Osoby' &&
            $_GET['table'] != 'Sklepy' &&
            $_GET['table'] != 'Kategorie' &&
            $_GET['table'] != 'Wydatki' &&
            $_GET['table'] != 'Logi' &&
            $_GET['table'] != 'Zasady' &&
            $_GET['table'] != 'Uprawnienia' &&
            $_GET['table'] != 'Użytkownicy')
            ) {
                ?>
                <div class="element-error flex-center"><strong>Upss... Coś poszło nie tak...</strong></div>
                <?php
                $error = true;
        }
        // If all is okay
        else {
            if (!isset($_COOKIE['id_user']) || $_COOKIE['id_user'] == -1) header('location: form?table=Użytkownicy&log');
            ?>
            <div>
                <h1 class="flex-center"><p>Raport tabeli</p>:&nbsp;<strong><?php echo $_GET['table']; ?></strong></h1>
            <?php

            if (!isset($_GET['page']) || !isset($_GET['count']) || $_GET['page'] < 1) {
                $_GET['page']  = 1;
                $_GET['count'] = 10;
                header('location: http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'].'/../report?table='.$_GET['table'].'&page='.$_GET['page'].'&count='.$_GET['count'].'');
            }

            // Display the rest
            $que = "EXECUTE proc_paging @table='view_select_all_".$_GET['table']."', @offset='".($_GET['page']-1)*$_GET['count']."', @count='".$_GET['count']."'";
            $res = sqlsrv_query($con, $que);

            $json_actions = json_decode(file_get_contents('assets/data/actions.json'), true);

            $i1 = hasRule($con, "Wyświetlanie")[0] & $json_actions[$_GET['table']]['selection'];
            $i2 = hasRule($con, "Modyfikacja")[0] & $json_actions[$_GET['table']]['pen'];
            $i3 = hasRule($con, "Usuwanie")[0] & $json_actions[$_GET['table']]['delete'];

            $ia = hasRule($con, "Administracja")[0];
            
            // Displaying the table
            echo '<div class="flex-center">';
            echo '<table class="__table-report __col3">';
                ?>
                <tr class="__col1">
                    <?php if ($_GET['table'] != 'Uprawnienia') { ?>
                    <th class="__table-tr-id">Nr</th>
                    <?php } ?>
                    <?php
                        $json = file_get_contents('assets/data/fields.json');
                        $headers = json_decode($json, true);
                        $table = $headers[$_GET['table']];
                        if ($_GET['table'] != 'Uprawnienia') unset($table[0]);

                        foreach ($table as $t) {
                            echo '<th>'.$t.'</th>';
                        }

                        $off = (($_GET['table'] != 'Uprawnienia') ? 1 : 2);
                    ?>
                    <?php
                        /*if ($_GET['table'] == 'Osoby')*/ echo '<th>Działania</th>';
                    ?>
                </tr>
                <?php
                $j = 0;
            while ($row = sqlsrv_fetch_array($res)) {
                $j++;
                $value = ($_GET['table'] != 'Uprawnienia') ? $row[0] : $row[0].'-'.$row[1];
                ?>
                    <tr value="<?php echo $value; ?>">
                        <?php if ($_GET['table'] != 'Uprawnienia') { ?>
                        <td class="__table-tr-id"><?php echo $row[0]; ?></td>
                        <?php } ?>
                        <?php
                            for ($i = $off; $i < count($table)+$off; $i++) {
                                if ($i > $_GET['count']) break;
                                if (gettype($row[$i]) == 'object') echo '<td>'.date_format($row[$i], 'Y-m-d').'</td>';
                                else if (isset($row['Kwota']) && $row[$i] == $row['Kwota']) echo '<td>'.number_format(round($row[$i], 2), 2, '.', '').'</td>';
                                else if (isset($row['Opis']) && $row[$i] == $row['Opis']) echo '<td><div class="cut-string" style="width: 322px">'.$row[$i].'</div></td>';
                                else echo '<td>'.$row[$i].'</td>';
                            }
                        ?>
                        <td class="flex-center">
                            <div>
                                <?php /*if (($_GET['table'] == 'Uprawnienia') && ($_GET['table'] != 'Użytkownicy' || $row[0] != 0)) {
                                    include('assets/img/svg/selection.svg');
                                    include('assets/img/svg/pen.svg');
                                    include('assets/img/svg/delete.svg');
                                } else*/ if (($i1 != 1 && $i2 != 1 && $i3 != 1 && $ia != 1) || ($_GET['table'] == 'Użytkownicy' && $row[0] == 0)) echo '<span>Nie masz żadnych uprawnień.</span>'; else { ?>
                                <span title="Przeglądaj"><?php if ($i1 == 1) { include('assets/img/svg/selection.svg'); } ?></span>
                                <span title="Edytuj"><?php if ($i2 == 1) { echo '<a href="form?table='.$_GET['table'].'&update&id='.$row[0].'">'; include('assets/img/svg/pen.svg'); echo '</a>'; } ?></span>
                                <?php if ($_GET['table'] == 'Uprawnienia' && (($row[0] == 0) || ($row[0] == $_COOKIE['id_user']) || $ia != 1)) echo '<span>Nie masz żadnych uprawnień.</span>'; else { ?><span title="Usuń"><?php if ($ia == 1 || $i3 == 1) include('assets/img/svg/trash.svg'); ?></span><?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                <?php
            }
            echo '</table>';
            echo '</div>';

            echo '</div>';

            //if ($j == 0) header('location: main');
        }
    ?>
    </div>

    <?php if (!$error) { ?>
    <div class="__panel-report-container flex-center">
        <div>
            <div class="__panel-report-text">Ilość rekordów:</div>
            <div>
                <section class="__panel-report __col3 flex-center">
                    <?php
                        $counts = array(10, 25, 50, 100);
                        for ($i = 0; $i < count($counts); $i++) {
                            if ($counts[$i] == $_GET['count']) { echo '<div>'.$_GET['count'].'</div>'; }
                            else {
                                ?><div><a href="report?table=<?php echo $_GET['table']?>&page=1&count=<?php echo $counts[$i]; ?>"><?php echo $counts[$i]; ?></a></div><?php
                            }
                        }
                    ?>
                </section>
            </div>
        </div>
        <div class="flex-center">
            <i>Strona:&nbsp;</i>
            <?php
                //$res = sqlsrv_query($con, 'SELECT [dbo].func_get_table_count("'.$_GET['table'].'", '.$_GET['count'].')');
                $res = sqlsrv_query($con, "EXEC proc_get_table_count @table='" . $_GET['table'] . "'");
                $row = sqlsrv_fetch_array($res);
                $lines = $row[0];
                if ($row[0] < $_GET['count']) $row[0] = 1;
                else $row[0] = (int) ($row[0]/$_GET['count'])+1;
                if ($lines % $_GET['count'] == 0) $row[0]--;

                if ($row[0] > 5) {
                    // First
                    if ($_GET['page'] == 1) {
                    ?>
                        <div>1,&nbsp;</div>
                    <?php } else { ?>
                        <a href="report?table=<?php echo $_GET['table']?>&page=1&count=<?php echo $_GET['count']; ?>"><div>1</div></a>,&nbsp;
                    <?php }
                    if ($_GET['page'] > 4) echo '...&nbsp;';

                    // Rest
                    $j = $_GET['page'] + 2;
                    for ($i = $_GET['page']-3; $i < $j; $i++) {
                        if ($i > 0 && $i < $row[0]-2) {
                            if ($i == $_GET['page']-1) echo '<div>'.($i+1).'</div>';
                            else echo '<a href="report?table='.$_GET['table'].'&page='.($i+1).'&count='.$_GET['count'].'"><div>'.($i+1).'</div></a>';
                            if ($i < $row[0] - 1) echo ',&nbsp;';
                        }
                    }
                    
                    // Last
                    if ($_GET['page'] - $row[0]+1 < -3) echo '...&nbsp;';
                    if ($_GET['page'] == $row[0]-1) {
                    ?>
                        <div><?php echo $row[0]-1; ?></div>
                    <?php } else { ?>
                    <a href="report?table=<?php echo $_GET['table']?>&page=<?php echo $row[0]-1; ?>&count=<?php echo $_GET['count']; ?>"><div><?php echo $row[0]-1; ?></div></a>
                    <?php }
                }
                else {
                    for ($i = 0; $i < $row[0]; $i++) {
                        if ($i+1 == $_GET['page']) echo '<div>'.($i+1).'</div>';
                        else echo '<a href="report?table='.$_GET['table'].'&page='.($i+1).'&count='.$_GET['count'].'"><div>'.($i+1).'</div></a>';

                        if ($i < $row[0]-1) echo ',&nbsp;';
                    }
                }
            ?>
        </div>
    </div>
    <?php } ?>
</main>