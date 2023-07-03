<?php
// Establecer la conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "Osc@r801223", "restaurante_coroso");

// Verificar si la conexión es exitosa
if (!$conexion) {
  die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

// Verificar la acción solicitada
if (isset($_GET["action"])) {
  $action = $_GET["action"];

  if ($action === "getEmpleados") {
    // Obtener todos los empleados
    $sql = "SELECT * FROM empleados";
    $resultado = mysqli_query($conexion, $sql);

    // Obtener los datos de los empleados en un arreglo
    $empleados = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
      $empleados[] = $row;
    }

    // Enviar los datos en formato JSON
    echo json_encode($empleados);
  } elseif ($action === "createEmpleado") {
    // Obtener los valores ingresados por el usuario
    $data = json_decode(file_get_contents("php://input"), true);
    $nombre = $data["nombre"];
    $apellido = $data["apellido"];
    $puesto = $data["puesto"];

    // Insertar un nuevo empleado en la base de datos
    $sql = "INSERT INTO empleados (nombre, apellido, puesto) VALUES ('$nombre', '$apellido', '$puesto')";
    mysqli_query($conexion, $sql);
  } elseif ($action === "updateEmpleado") {
    // Obtener los valores ingresados por el usuario
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data["id"];
    $nombre = $data["nombre"];
    $apellido = $data["apellido"];
    $puesto = $data["puesto"];

    // Actualizar el empleado en la base de datos
    $sql = "UPDATE empleados SET nombre='$nombre', apellido='$apellido', puesto='$puesto' WHERE id='$id'";
    mysqli_query($conexion, $sql);
  } elseif ($action === "deleteEmpleado") {
    // Obtener el ID del empleado a eliminar
    $id = $_GET["id"];

    // Eliminar el empleado de la base de datos
    $sql = "DELETE FROM empleados WHERE id = '$id'";
    mysqli_query($conexion, $sql);
  }
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
