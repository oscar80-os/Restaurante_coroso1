<?php
function obtenerProductos()
{
    include 'config.php';

    $productos = [];

    $sql = "SELECT * FROM productos";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $producto = [
                'nombre' => $row["nombre"],
                'cantidad' => $row["cantidad"]
            ];

            $productos[] = $producto;
        }
    }

    return $productos;
}
?>
