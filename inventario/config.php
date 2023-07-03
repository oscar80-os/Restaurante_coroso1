<?php
$servername = "localhost";
$username = "root";
$password = "Osc@r801223";
$dbname = "restaurante_coroso";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
