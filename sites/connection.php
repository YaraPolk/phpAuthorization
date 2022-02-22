<?php
$host = 'mysql';
$user = 'root';
$password = 'test';
$dbname = 'phpAuthorization';

$connection = mysqli_connect($host, $user, $password, $dbname);
mysqli_query($connection, "SET NAMES 'utf8'");
