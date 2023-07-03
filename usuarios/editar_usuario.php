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

// Obtener el ID del usuario a editar
$id = $_GET['id'];

// Obtener los datos del usuario de la base de datos usando el ID
$sql = "SELECT * FROM usuarios WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Mostrar el formulario de edición con los datos del usuario
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
</head>
<body>
    <h2>Editar Usuario</h2>
    <form action="editar_usuario.php?id=<?php echo $id; ?>" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" required>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" value="<?php echo $row['apellido']; ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>

        <button type="submit" name="actualizar_usuario">Actualizar</button>
    </form>
    <?php

    // Procesar los datos enviados por el formulario y actualizar el usuario en la base de datos
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["actualizar_usuario"])) {
        $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
        $apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : "";
        $email = isset($_POST["email"]) ? $_POST["email"] : "";

        // Validación y filtrado de datos
        $nombre = mysqli_real_escape_string($conn, $nombre);
        $apellido = mysqli_real_escape_string($conn, $apellido);
        $email = mysqli_real_escape_string($conn, $email);

        $sql = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', email='$email' WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo "Usuario actualizado exitosamente";
        } else {
            echo "Error al actualizar el usuario: " . $conn->error;
        }
    }

    $conn->close();
    ?>
</body>
</html>
