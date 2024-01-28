<?php
require_once('globals.php');
$host = DB['HOST'];
$user = DB['USER'];
$pass = DB['PASS'];
$dbname = DB['DBNAME'];

$conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);