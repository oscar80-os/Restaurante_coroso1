<?php

// Conexión a la base de datos (MySQL)
$servername = "localhost";
$username = "root";
$password = "Osc@r801223";
$dbname = "restaurante_coroso";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Crear un nuevo menú
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $platos = $_POST["platos"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $opcionesPersonalizacion = $_POST["opcionesPersonalizacion"];

    $sql = "INSERT INTO menus (platos, descripcion, precio, opciones_personalizacion) VALUES ('$platos', '$descripcion', '$precio', '$opcionesPersonalizacion')";

    if ($conn->query($sql) === TRUE) {
        echo "Menú creado exitosamente";
    } else {
        echo "Error al crear el menú: " . $conn->error;
    }
}

// Actualizar un menú existente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $platos = $_POST["platos"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $opcionesPersonalizacion = $_POST["opcionesPersonalizacion"];

    $sql = "UPDATE menus SET platos='$platos', descripcion='$descripcion', precio='$precio', opciones_personalizacion='$opcionesPersonalizacion' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Menú actualizado exitosamente";
    } else {
        echo "Error al actualizar el menú: " . $conn->error;
    }
}

$conn->close();

?>
