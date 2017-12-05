<?php
    $host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "szkolnaligastrzelecka";

    @mysql_connect($host, $db_user, $db_password);
    @mysql_select_db($db_name);
?>
