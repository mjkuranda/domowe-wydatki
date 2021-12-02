<?php
    // Fetch datas
    $time       = sqlsrv_query($con, 'EXEC proc_select_time');
    $time_res   = sqlsrv_fetch_array($time);

    // Print datas
    echo '<div class="server-time">' . $time_res[0]->format('H:i:s') . '</div>';
    echo ',&nbsp;';
    echo '<div class="server-timezone">' . $time_res[0]->getTimezone()->getName() . '</div>';
?>