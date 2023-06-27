<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "Osc@r801223";
$dbname = "restaurante_pueba";

// Establecer la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Manejar la solicitud de guardar datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $name = $data['name'];
    $email = $data['email'];
    
    $sql = "INSERT INTO usuarios (nombre, email) VALUES ('$name', '$email')";
    
    if ($conn->query($sql) === TRUE) {
        $response = array('success' => true);
    } else {
        $response = array('success' => false, 'error' => $conn->error);
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

// Manejar la solicitud de obtener datos
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
?>
