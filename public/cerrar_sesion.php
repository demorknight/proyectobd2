<?php
session_start();
session_unset();  // Limpia todas las variables de sesión
session_destroy(); // Destruye la sesión actual

// Redirige al inicio (login)
header("Location: index.php");
exit;
?>
