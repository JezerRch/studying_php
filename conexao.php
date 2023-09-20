<?php


$db = 'mysql';
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'testephp';

$conn = mysqli_connect($host, $user, $pass, $dbname);

// if (!$conn) {
//     echo 'Erro ' . mysqli_connect_error();
// } else {
//     echo 'Conectado';
// }
