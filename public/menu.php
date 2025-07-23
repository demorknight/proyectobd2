<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú Principal</title>
    <link rel="stylesheet" href="../assets/css/menu.css">
</head>
<body>

<header class="head">
    <img src="../assets/imagen/logo.jpg" alt="Logo Empresa" style="height: 80px; margin-bottom: 10px;">
    <h1>CARPINTERÍA Y DISEÑO T.S.</h1>
    <h5>¡Diseñamos al alcance de tu presupuesto!</h5>
</header>

<section class="espacio"></section>

<main class="menu-contenido">
    <h2>Bienvenido al sistema D-TECH</h2>
    <p>Selecciona una opción para continuar:</p>

    <div class="botones-menu">
        <a href="formulario.php" class="btn">📄 Crear Documento</a>
        <a href="registrar_cliente.html" class="btn">👤 Registrar Cliente</a>
        <a href="listar_documentos.php" class="btn">📋 Ver Documentos</a>
        <a href="listar_productos.php" class="btn">🛠 Gestión de Productos</a>
        <a href="cerrar_sesion.php" class="btn salir">🚪 Cerrar Sesión</a>
    </div>
</main>

<aside class="empresa">
    <h6>Elaborado por DEEP TECH 2025</h6>
</aside>

</body>
</html>

