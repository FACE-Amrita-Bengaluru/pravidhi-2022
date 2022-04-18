<?php

define('username', 'sathian');
define('password', 'face');

function isValidUsername($user) : bool {
    return $user == username;
}

function Sathian() {
    $user = $_POST['cUsername'];
    $pass = $_POST['cPass'];
}
?>