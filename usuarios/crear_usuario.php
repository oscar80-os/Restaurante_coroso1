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

// Obtener los datos enviados por el formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$password = $_POST['password'];

// Validar y guardar los datos en la base de datos
// Código para insertar los datos en la tabla 'usuarios', incluyendo la contraseña

// Hash de la contraseña
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nombre, apellido, email, contraseña) VALUES ('$nombre', '$apellido', '$email', '$hashedPassword')";

if ($conn->query($sql) === TRUE) {
    echo "Usuario creado exitosamente";
} else {
    echo "Error al crear el usuario: " . $conn->error;
}

// Redireccionar al archivo index.php después de guardar el usuario
$conn->close();
header("Location: index.php");
exit();
?>
