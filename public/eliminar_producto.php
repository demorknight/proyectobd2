<?php
require_once '../config/db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Producto no especificado.");
}

$stmt = $conn->prepare("DELETE FROM productos WHERE id_producto = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: listar_productos.php");
    exit;
} else {
    echo "❌ Error al eliminar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
