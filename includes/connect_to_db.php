<?php
    require_once "database_relay.php";
    require_once "talkers.php";

    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'pravidhi');

    try {
        $connection_test = new DB_Relay(
            DB_HOST,
            DB_USER,
            DB_PASSWORD,
            DB_NAME
        );
    } catch (Exception $e) {
        throwAlert('Server connection failure. Please try again later or contact our dev team');
        consoleBug($e -> getMessage());
        die('good bye cruel world');
    } finally {
        $dbc = $connection_test;
    }
?>