<?php
    require_once "database_relay.php";

    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'database_project');

    $dbc = new DB_Relay(
        DB_HOST,
        DB_USER,
        DB_PASSWORD,
        DB_NAME
    );
?>