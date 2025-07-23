<?php
require_once '../config/db.php';

$numero = $_GET['numero'] ?? null;
$tipo = $_GET['tipo'] ?? null;

if (!$numero || !$tipo) {
    die("Documento no especificado.");
}

// Consultar encabezado del documento
$sql = "SELECT d.id_documento, d.numero_consecutivo, d.tipo, d.fecha_emision, d.medio_pago, d.total,
               c.nombre, c.identificacion, c.telefono, c.correo, c.direccion
        FROM documentos d
        INNER JOIN clientes c ON d.id_cliente = c.id_cliente
        WHERE d.numero_consecutivo = ? AND d.tipo = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $numero, $tipo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    die("Documento no encontrado.");
}

$doc = $resultado->fetch_assoc();
$idDocumento = $doc['id_documento'];
$stmt->close();

// Consultar productos asociados
$sqlProductos = "SELECT nombre_producto, cantidad, precio_unitario, subtotal
                 FROM detalle_documento
                 WHERE id_documento = ?";
$stmt = $conn->prepare($sqlProductos);
$stmt->bind_param("i", $idDocumento);
$stmt->execute();
$productos = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= ucfirst($doc['tipo']) ?> #<?= $doc['numero_consecutivo'] ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background-color: #fdfdfd;
        }
        .encabezado {
            text-align: center;
            margin-bottom: 30px;
        }
        .bloque {
            margin-bottom: 20px;
        }
        h2 {
            margin-bottom: 5px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f0f0f0;
        }
        .resumen {
            text-align: right;
            font-size: 16px;
            margin-top: 10px;
            font-weight: bold;
        }
        .volver, .imprimir {
            margin-top: 20px;
            display: inline-block;
        }
        .imprimir {
            margin-left: 15px;
        }
    </style>
</head>
<body>

    <div class="encabezado">
        <h1>CARPINTERÍA Y DISEÑO T.S.</h1>
        <h4>¡Diseñamos al alcance de tu presupuesto!</h4>
        <p><strong><?= ucfirst($doc['tipo']) ?> #<?= $doc['numero_consecutivo'] ?></strong></p>
    </div>

    <div class="bloque">
        <strong>Fecha de emisión:</strong> <?= $doc['fecha_emision'] ?><br>
        <strong>Medio de pago:</strong> <?= ucfirst($doc['medio_pago']) ?>
    </div>

    <div class="bloque">
        <h3>Datos del Cliente</h3>
        <strong>Nombre:</strong> <?= htmlspecialchars($doc['nombre']) ?><br>
        <strong>Identificación:</strong> <?= $doc['identificacion'] ?><br>
        <strong>Teléfono:</strong> <?= $doc['telefono'] ?><br>
        <strong>Correo:</strong> <?= $doc['correo'] ?><br>
        <strong>Dirección:</strong> <?= $doc['direccion'] ?>
    </div>

    <div class="bloque">
        <h3>Detalle del Documento</h3>
        <table>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
            <?php while ($p = $productos->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($p['nombre_producto']) ?></td>
                <td><?= $p['cantidad'] ?></td>
                <td>$<?= number_format($p['precio_unitario'], 0, ',', '.') ?></td>
                <td>$<?= number_format($p['subtotal'], 0, ',', '.') ?></td>
            </tr>
            <?php endwhile; ?>
        </table>

        <div class="resumen">
            Total: $<?= number_format($doc['total'], 0, ',', '.') ?>
        </div>
    </div>

    <!-- Enlaces al final -->
    <a class="volver" href="listar_documentos.php">⬅ Volver al listado</a>
    <button class="imprimir" onclick="window.print()">🖨 Imprimir documento</button>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
