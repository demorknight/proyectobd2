<?php
// config/db.php
$host = 'localhost';
$usuario = 'root';       // Cambia si es necesario
$contrasena = '';        // Cambia si tienes contraseña
$baseDatos = 'dtech';

$conn = new mysqli($host, $usuario, $contrasena, $baseDatos);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
