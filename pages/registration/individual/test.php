<?php
$_INCLUDE_DIR = $_SERVER['DOCUMENT_ROOT'] . '/pravidhi-2022/includes/';
require_once $_INCLUDE_DIR . 'dependencies.php';

if (Validate::RegNo("BL.EN.U4CSE19147"))
    echo "valid";
else
    echo "invalid";
