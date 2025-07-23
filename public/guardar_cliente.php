<?php
require_once '../config/db.php';

// Recibir datos del formulario
$nombre = $_POST['nombre'] ?? null;
$identificacion = $_POST['identificacion'] ?? null;
$telefono = $_POST['telefono'] ?? null;
$correo = $_POST['correo'] ?? null;
$direccion = $_POST['direccion'] ?? null;

// Validación básica
if (!$nombre || !$identificacion) {
    die("Faltan datos obligatorios (nombre o identificación).");
}

// Insertar cliente en la base de datos
$sql = "INSERT INTO clientes (nombre, identificacion, telefono, correo, direccion) 
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $nombre, $identificacion, $telefono, $correo, $direccion);

if ($stmt->execute()) {
    echo "✅ Cliente registrado correctamente. ID generado: " . $stmt->insert_id;
} else {
    echo "❌ Error al registrar cliente: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
