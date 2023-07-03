<!DOCTYPE html>
<html>
<head>
    <title>Inventario de Restaurante</title>
    <link rel="icon" href="../img/cocinera_logo.png">
    <link rel="stylesheet" type="text/css" href="inventario.css">
</head>
<body>
    <img class="logo" src="../img/cocinera_logo.png" alt="logo">
    <h1>Inventario de Restaurante</h1>
    <form action="agregar_producto.php" method="POST">
        <label for="nombre">Nombre del Producto:</label>
        <input type="text" name="nombre" required><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" required><br>

        <input type="submit" value="Agregar Producto">
    </form>
    <br>
    <h2>Listado de Productos:</h2>
    <?php
        include 'inventario.php';

        $productos = obtenerProductos();

        if (!empty($productos)) {
            foreach ($productos as $producto) {
                echo "<p><strong>Nombre:</strong> " . $producto['nombre'] . "</p>";
                echo "<p><strong>Cantidad:</strong> " . $producto['cantidad'] . "</p>";
                echo "<hr>";
            }
        } else {
            echo "No hay productos en el inventario.";
        }
    ?>
</body>
</html>
