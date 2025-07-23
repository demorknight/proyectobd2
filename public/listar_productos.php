<?php
require_once '../config/db.php';

$resultado = $conn->query("SELECT * FROM productos ORDER BY nombre ASC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Productos</title>
    <style>
        table {
            width: 90%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #999;
            padding: 8px;
            text-align: center;
        }
        th {
            background: #f0f0f0;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

    <h2>Catálogo de Productos</h2>

    <table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Acciones</th>
    </tr>
    <?php while ($p = $resultado->fetch_assoc()): ?>
    <tr>
        <td><?= $p['id_producto'] ?></td>
        <td><?= htmlspecialchars($p['nombre']) ?></td>
        <td><?= nl2br(htmlspecialchars($p['descripcion'])) ?></td>
        <td>$<?= number_format($p['precio'], 0, ',', '.') ?></td>
        <td>
            <a href="editar_producto.php?id=<?= $p['id_producto'] ?>">✏️ Editar</a> |
            <a href="eliminar_producto.php?id=<?= $p['id_producto'] ?>" onclick="return confirm('¿Eliminar este producto?');">🗑 Eliminar</a>
        </td>
    </tr>
    <?php endwhile; ?>
    </table>

</body>
</html>

<?php $conn->close(); ?>
