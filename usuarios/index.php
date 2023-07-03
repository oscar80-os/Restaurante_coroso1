<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../usuarios/usuarios.css">
    <title>Gestión de Usuarios</title>
    <link rel="icon" href="../img/cocinera_logo.png">
    
</head>
<body>
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

    // Crear un nuevo usuario
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["crear_usuario"])) {
        $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
        $apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : "";
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $password = isset($_POST["password"]) ? $_POST["password"] : "";

        // Validación y filtrado de datos
        $nombre = mysqli_real_escape_string($conn, $nombre);
        $apellido = mysqli_real_escape_string($conn, $apellido);
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);

        // Hash de la contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nombre, apellido, email, contraseña) VALUES ('$nombre', '$apellido', '$email', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
            echo "Usuario creado exitosamente";
        } else {
            echo "Error al crear el usuario: " . $conn->error;
        }
    }

    // Consultar los usuarios
    $sql = "SELECT * FROM usuarios";
    $result = $conn->query($sql);

    ?>
    
    <img class="icono" src="../img/cocinera_logo.png" alt="">
    <h1>Gestión de Usuarios</h1>

    <h2>Crear Usuario</h2>
    <form action="index.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" name="crear_usuario">Crear</button>
    </form>

    <h2>Lista de Usuarios</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["apellido"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td><a href='editar_usuario.php?id=" . $row["id"] . "'>Editar</a> <a href='eliminar_usuario.php?id=" . $row["id"] . "'>Eliminar</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No se encontraron usuarios</td></tr>";
        }
        ?>
    </table>

    <?php
    $conn->close();
    ?>
</body>
</html>
