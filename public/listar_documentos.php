<?php
require_once '../config/db.php';

// Consulta para obtener documentos con nombre del cliente
$sql = "SELECT d.numero_consecutivo, d.tipo, d.fecha_emision, c.nombre AS cliente, d.medio_pago, d.total
        FROM documentos d
        INNER JOIN clientes c ON d.id_cliente = c.id_cliente
        ORDER BY d.fecha_emision DESC, d.numero_consecutivo DESC";

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Documentos Generados</title>
    <style>
        table {
            border-collapse: collapse;
            width: 90%;
            margin: 20px auto;
        }
        th, td {
            padding: 10px;
            border: 1px solid #999;
            text-align: center;
        }
        th {
            background-color: #eee;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Listado de Documentos Generados</h2>
    <table>
        <tr>
            <th>#</th>
            <th>Tipo</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Medio de Pago</th>
            <th>Total</th>
            <th>Ver</th>

        </tr>

        <?php if ($resultado->num_rows > 0): ?>
            <?php while($fila = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($fila['numero_consecutivo']) ?></td>
                    <td><?= ucfirst($fila['tipo']) ?></td>
                    <td><?= $fila['fecha_emision'] ?></td>
                    <td><?= htmlspecialchars($fila['cliente']) ?></td>
                    <td><?= ucfirst($fila['medio_pago']) ?></td>
                    <td>$<?= number_format($fila['total'], 0, ',', '.') ?></td>
                    <td>
                        <a href="ver_documento.php?numero=<?= $fila['numero_consecutivo'] ?>&tipo=<?= $fila['tipo'] ?>">Ver</a>
        <           /td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="6">No se han generado documentos aún.</td></tr>
        <?php endif; ?>

    </table>
</body>
</html>

<?php
$conn->close();
?>
