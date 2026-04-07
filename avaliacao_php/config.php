<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "meura_2025106462";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Erro na conexão: " . mysqli_connect_error());
}
?>