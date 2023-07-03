<?php
    // Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "Osc@r801223";
$dbname = "restaurante_coroso";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}


    // Obtener el ID del usuario a eliminar
    $id = $_GET['id'];

    // Eliminar el usuario de la base de datos usando el ID
    $sql = "DELETE FROM usuarios WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Usuario eliminado exitosamente";
    } else {
        echo "Error al eliminar el usuario: " . $conn->error;
    }

    // Redireccionar al archivo index.php después de eliminar el usuario
    header("Location: index.php");
    exit();
?>
