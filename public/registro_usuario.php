<?php
require_once '../config/db.php';

// Obtener datos del formulario
$identificacion = $_POST['identificacion'] ?? null;
$nombre = $_POST['nombre_usuario'] ?? null;
$correo = $_POST['correo'] ?? null;
$contrasena = $_POST['contrasena'] ?? null;
$rol = $_POST['rol'] ?? 'vendedor'; // Valor por defecto

// Validación básica
if (!$identificacion || !$nombre || !$correo || !$contrasena) {
    die("❌ Faltan campos obligatorios.");
}

// Verificar si ya existe un usuario con esa identificación
$sql_check = "SELECT id_usuario FROM usuarios WHERE identificacion = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $identificacion);
$stmt_check->execute();
$stmt_check->store_result();

if ($stmt_check->num_rows > 0) {
    echo "<script>alert('❌ Ya existe un usuario con esa identificación.'); window.location.href = 'index.php';</script>";
    exit;
}
$stmt_check->close();

// Insertar nuevo usuario
$sql = "INSERT INTO usuarios (identificacion, nombre_usuario, correo, contraseña, rol)
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $identificacion, $nombre, $correo, $contrasena, $rol);

if ($stmt->execute()) {
    echo "<script>alert('✅ Registro exitoso. Ahora puedes iniciar sesión.'); window.location.href = 'index.php';</script>";
} else {
    echo "<script>alert('❌ Error al registrar el usuario: " . $stmt->error . "'); window.location.href = 'index.php';</script>";
}

$stmt->close();
$conn->close();
?>
