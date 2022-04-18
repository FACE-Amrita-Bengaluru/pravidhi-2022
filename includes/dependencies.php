<?php
function throwAlert($message) {
    echo "<script>alert('$message')</script>";
}

$_INCLUDE_DIR = $_SERVER['DOCUMENT_ROOT'] . '/pravidhi-2022/includes/';

require_once $_INCLUDE_DIR . "connect_to_db.php";
require_once $_INCLUDE_DIR . "query_capsule.php";
require_once $_INCLUDE_DIR . "validation.php";
?>