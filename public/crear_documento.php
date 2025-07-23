<?php
require_once '../config/db.php';
require_once '../functions/consecutivo.php';

$tipoDocumento = $_POST['tipo_documento'] ?? null;
$identificacion = $_POST['identificacion'] ?? null;
$medioPago = $_POST['medio_pago'] ?? null;
$productos = $_POST['productos'] ?? [];

$direccionEnvio = $_POST['direccion_envio'] ?? '';
$costoEnvio = floatval($_POST['costo_envio'] ?? 0);
$abono = floatval($_POST['abono'] ?? 0);

if (!$tipoDocumento || !$identificacion || !$medioPago || empty($productos)) {
    die("❌ Faltan datos obligatorios.");
}

// Buscar el cliente
$sqlBuscar = "SELECT id_cliente FROM clientes WHERE identificacion = ?";
$stmt = $conn->prepare($sqlBuscar);
$stmt->bind_param("s", $identificacion);
$stmt->execute();
$stmt->bind_result($idCliente);
$stmt->fetch();
$stmt->close();

if (!$idCliente) {
    echo "<p style='color:red; font-weight:bold;'>❌ El cliente con identificación $identificacion no está registrado.</p>";
    echo "<a href='menu.php' style='display:inline-block; margin-top:10px; background-color:red; color:white; padding:10px; text-decoration:none;'>⬅ Volver al menú</a>";
    exit;
}

// Calcular el total de productos
$total = 0;
foreach ($productos as $p) {
    $cantidad = floatval($p['cantidad'] ?? 0);
    $precio = floatval($p['precio'] ?? 0);
    $total += $cantidad * $precio;
}

// Sumar costo de envío al total
$total += $costoEnvio;

// Obtener nuevo número de documento
$consecutivo = obtenerConsecutivo($conn);

// Insertar documento
$sqlInsert = "INSERT INTO documentos (tipo, numero_consecutivo, fecha_emision, id_cliente, medio_pago, total)
              VALUES (?, ?, CURDATE(), ?, ?, ?)";
$stmt = $conn->prepare($sqlInsert);
$stmt->bind_param("ssiss", $tipoDocumento, $consecutivo, $idCliente, $medioPago, $total);
$stmt->execute();
$idDocumento = $stmt->insert_id;
$stmt->close();

// Insertar los productos asociados
$sqlDetalle = "INSERT INTO detalle_documento (id_documento, nombre_producto, cantidad, precio_unitario, subtotal)
               VALUES (?, ?, ?, ?, ?)";

foreach ($productos as $p) {
    $idProducto = intval($p['id']);
    $cantidad = floatval($p['cantidad']);
    $precio = floatval($p['precio']);
    $subtotal = $cantidad * $precio;

    // Obtener el nombre del producto desde la base de datos
    $sqlNombre = "SELECT nombre FROM productos WHERE id_producto = ?";
    $stmtNombre = $conn->prepare($sqlNombre);
    $stmtNombre->bind_param("i", $idProducto);
    $stmtNombre->execute();
    $stmtNombre->bind_result($nombre);
    $stmtNombre->fetch();
    $stmtNombre->close();

    // Insertar en detalle_documento
    $stmt = $conn->prepare($sqlDetalle);
    $stmt->bind_param("isidd", $idDocumento, $nombre, $cantidad, $precio, $subtotal);
    $stmt->execute();
    $stmt->close();
}

$conn->close();

// Mostrar resumen
echo "<p style='color:green; font-weight:bold;'>✅ Documento creado correctamente con número: $consecutivo</p>";
echo "<p>📦 Dirección de envío: " . htmlspecialchars($direccionEnvio) . "</p>";
echo "<p>🚚 Costo de envío: $" . number_format($costoEnvio, 2) . "</p>";
echo "<p>💵 Abono realizado: $" . number_format($abono, 2) . "</p>";
echo "<p>🔖 Saldo pendiente: $" . number_format($total - $abono, 2) . "</p>";

echo "<a href='ver_documento.php?numero=$consecutivo&tipo=$tipoDocumento' 
      style='display:inline-block; margin-top:10px; background-color:green; color:white; padding:10px; text-decoration:none;'>Ver documento</a>";
