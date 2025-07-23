<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $precio = $_POST['precio'] ?? 0;

    if ($nombre && $precio > 0) {
        $sql = "INSERT INTO productos (nombre, descripcion, precio) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssd", $nombre, $descripcion, $precio);
        if ($stmt->execute()) {
            echo "✅ Producto registrado correctamente.";
        } else {
            echo "❌ Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "❌ Nombre y precio son obligatorios.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Producto</title>
</head>
<body>
    <h2>Registrar nuevo producto</h2>
    <form method="POST">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Descripción:</label><br>
        <textarea name="descripcion"></textarea><br><br>

        <label>Precio:</label><br>
        <input type="number" step="0.01" name="precio" required><br><br>

        <button type="submit">Guardar producto</button>
    </form>
</body>
</html>
