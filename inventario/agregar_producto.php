<?php
include 'config.php';

$nombre = $_POST['nombre'];
$cantidad = $_POST['cantidad'];

$sql = "INSERT INTO productos (nombre, cantidad) VALUES ('$nombre', $cantidad)";

if ($conn->query($sql) === TRUE) {
    echo "Producto agregado correctamente.";
} else {
    echo "Error al agregar el producto: " . $conn->error;
}

$conn->close();
?>
