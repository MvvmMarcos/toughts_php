<?php
session_start();
ob_start();
$URL = "http://". $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI'] . "?") . "/";

//credenciais do banco de dados

define('DB', [
    'HOST'=> 'localhost',
    'USER'=> 'root',
    'PASS'=> '',
    'DBNAME'=> 'toughts'
]);