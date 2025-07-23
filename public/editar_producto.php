<?php
require_once '../config/db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Producto no especificado.");
}

// Obtener datos actuales
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $stmt = $conn->prepare("SELECT * FROM productos WHERE id_producto = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $producto = $resultado->fetch_assoc();
    $stmt->close();
    if (!$producto) {
        die("Producto no encontrado.");
    }
} else {
    // Actualizar producto
    $nombre = $_POST['nombre'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $precio = $_POST['precio'] ?? 0;

    if ($nombre && $precio > 0) {
        $stmt = $conn->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio = ? WHERE id_producto = ?");
        $stmt->bind_param("ssdi", $nombre, $descripcion, $precio, $id);
        if ($stmt->execute()) {
            echo "✅ Producto actualizado correctamente.<br>";
            echo '<a href="listar_productos.php">⬅ Volver al listado</a>';
            exit;
        } else {
            echo "❌ Error al actualizar: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "❌ Nombre y precio válidos son obligatorios.";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
</head>
<body>
    <h2>Editar Producto</h2>
    <form method="POST">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required><br><br>

        <label>Descripción:</label><br>
        <textarea name="descripcion"><?= htmlspecialchars($producto['descripcion']) ?></textarea><br><br>

        <label>Precio:</label><br>
        <input type="number" step="0.01" name="precio" value="<?= $producto['precio'] ?>" required><br><br>

        <button type="submit">Guardar cambios</button>
    </form>
</body>
</html>
