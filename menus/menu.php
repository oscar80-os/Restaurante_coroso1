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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["crear_menu"])) {
    $platos = $_POST["platos"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $opcionesPersonalizacion = $_POST["opcionesPersonalizacion"];

    // Validación y filtrado de datos
    $platos = mysqli_real_escape_string($conn, $platos);
    $descripcion = mysqli_real_escape_string($conn, $descripcion);
    $precio = mysqli_real_escape_string($conn, $precio);
    $opcionesPersonalizacion = mysqli_real_escape_string($conn, $opcionesPersonalizacion);

    $stmt = $conn->prepare("INSERT INTO menus (platos, descripcion, precio, opciones_personalizacion) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $platos, $descripcion, $precio, $opcionesPersonalizacion);

    if ($stmt->execute()) {
        echo "Menú creado exitosamente";
        exit();
    } else {
        echo "Error al crear el menú: " . $conn->error;
    }

    $stmt->close();
}

// Actualizar un menú existente
elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["actualizar_menu"])) {
    $id = $_POST["id"];
    $platos = $_POST["platos"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $opcionesPersonalizacion = $_POST["opcionesPersonalizacion"];

    // Validación y filtrado de datos
    $id = mysqli_real_escape_string($conn, $id);
    $platos = mysqli_real_escape_string($conn, $platos);
    $descripcion = mysqli_real_escape_string($conn, $descripcion);
    $precio = mysqli_real_escape_string($conn, $precio);
    $opcionesPersonalizacion = mysqli_real_escape_string($conn, $opcionesPersonalizacion);

    $stmt = $conn->prepare("UPDATE menus SET platos=?, descripcion=?, precio=?, opciones_personalizacion=? WHERE id=?");
    $stmt->bind_param("ssssi", $platos, $descripcion, $precio, $opcionesPersonalizacion, $id);

    if ($stmt->execute()) {
        echo "Menú actualizado exitosamente";
        exit();
    } else {
        echo "Error al actualizar el menú: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
