<?php
session_start();
require_once '../config/db.php';

$identificacion = $_POST['identificacion'] ?? '';
$contrasena = $_POST['Contrasena'] ?? '';

if (empty($identificacion) || empty($contrasena)) {
    echo "<script>
            alert('❌ Debes completar ambos campos');
            window.history.back();
          </script>";
    exit;
}

$sql = "SELECT * FROM usuarios WHERE identificacion = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $identificacion);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $usuario = $result->fetch_assoc();
    
    if ($usuario['contraseña'] === $contrasena) {
        $_SESSION['usuario'] = $usuario['nombre_usuario'];
        $_SESSION['rol'] = $usuario['rol'];
        
        echo "<script>
                alert('✅ Bienvenido {$usuario['nombre_usuario']}');
                window.location.href = '../public/menu.php';
              </script>";
    } else {
        echo "<script>
                alert('❌ Contraseña incorrecta');
                window.history.back();
              </script>";
    }
} else {
    echo "<script>
            alert('❌ Usuario no encontrado');
            window.history.back();
          </script>";
}

$stmt->close();
$conn->close();
?>
