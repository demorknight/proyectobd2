<?php
session_start();
require_once '../config/db.php';

// Obtener productos desde la base de datos
$productos = [];
$sql = "SELECT id_producto, nombre, precio FROM productos ORDER BY nombre";
$resultado = $conn->query($sql);
while ($row = $resultado->fetch_assoc()) {
    $productos[] = $row;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Documento</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        body {
            background-image: url('../assets/imagen/fondo1.jpg');
            background-size: cover;
            background-attachment: fixed;
            font-family: "Montserrat", sans-serif;
        }

        header {
            border: 10px solid rgb(160, 93, 5);
            background-color: rgb(160, 93, 5);
            color: white;
            padding: 10px;
            text-align: center;
        }

        main {
            max-width: 900px;
            margin: 60px auto;
            padding: 20px;
            background-color: rgba(255,255,255,0.9);
            border-radius: 15px;
            box-shadow: 0 0 12px rgba(0,0,0,0.3);
        }

        h2 {
            text-align: center;
            color: #a05d05;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        select, input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 8px;
            border: 1px solid #aaa;
            text-align: center;
        }

        .btn-agregar {
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #a05d05;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .total {
            text-align: right;
            font-size: 18px;
            margin-top: 15px;
            font-weight: bold;
        }

        .submit {
            display: block;
            margin: 30px auto 0;
            padding: 10px 30px;
            font-size: 16px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<header>
    <h1>CARPINTERÍA Y DISEÑO T.S.</h1>
    <h5>¡Diseñamos al alcance de tu presupuesto!</h5>
</header>

<main>
    <h2>Crear Factura o Cotización</h2>

    <form action="crear_documento.php" method="post" id="formDocumento">
        <label>Tipo de documento:</label>
        <select name="tipo_documento" required>
            <option value="factura">Factura</option>
            <option value="cotizacion">Cotización</option>
        </select>

        <label>Identificación del cliente:</label>
        <input type="text" name="identificacion" required>

        <label>Medio de pago:</label>
        <select name="medio_pago" required>
            <option value="efectivo">Efectivo</option>
            <option value="transferencia">Transferencia</option>
        </select>

        <h3>Productos</h3>
        <table id="tablaProductos">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="productos[0][id]" onchange="actualizarPrecio(this)" required>
                            <option value="">Seleccione...</option>
                            <?php foreach ($productos as $p): ?>
                                <option value="<?= $p['id_producto'] ?>" data-precio="<?= $p['precio'] ?>">
                                    <?= htmlspecialchars($p['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td><input type="number" name="productos[0][cantidad]" value="1" min="1" onchange="calcularTotales()" required></td>
                    <td><input type="number" name="productos[0][precio]" step="0.01" readonly></td>
                    <td class="subtotal">$0</td>
                    <td><button type="button" onclick="eliminarFila(this)">Eliminar</button></td>
                </tr>
            </tbody>
        </table>

        <button type="button" class="btn-agregar" onclick="agregarFila()">+ Agregar producto</button>

        <label>Dirección de envío:</label>
        <input type="text" name="direccion_envio" placeholder="Ej: Calle 10 #10-20, Bogotá">

        <label>Costo de envío:</label>
        <input type="number" name="costo_envio" min="0" step="0.01" value="0" onchange="calcularTotales()">

        <label>Abono realizado:</label>
        <input type="number" name="abono" min="0" step="0.01" value="0">

        <div class="total">Total: $<span id="total">0</span></div>

        <button type="submit" class="submit">Crear Documento</button>
    </form>
</main>

<script>
let contador = 1;

function agregarFila() {
    const tabla = document.querySelector('#tablaProductos tbody');
    const nuevaFila = document.createElement('tr');

    nuevaFila.innerHTML = `
        <td>
            <select name="productos[${contador}][id]" onchange="actualizarPrecio(this)" required>
                <option value="">Seleccione...</option>
                <?php foreach ($productos as $p): ?>
                    <option value="<?= $p['id_producto'] ?>" data-precio="<?= $p['precio'] ?>">
                        <?= htmlspecialchars($p['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </td>
        <td><input type="number" name="productos[${contador}][cantidad]" value="1" min="1" onchange="calcularTotales()" required></td>
        <td><input type="number" name="productos[${contador}][precio]" step="0.01" readonly></td>
        <td class="subtotal">$0</td>
        <td><button type="button" onclick="eliminarFila(this)">Eliminar</button></td>
    `;
    tabla.appendChild(nuevaFila);
    contador++;
}

function actualizarPrecio(select) {
    const precio = select.options[select.selectedIndex].dataset.precio;
    const fila = select.closest('tr');
    fila.querySelector('[name*="[precio]"]').value = precio;
    calcularTotales();
}

function calcularTotales() {
    let total = 0;
    document.querySelectorAll('#tablaProductos tbody tr').forEach(fila => {
        const cantidad = parseFloat(fila.querySelector('[name*="[cantidad]"]').value) || 0;
        const precio = parseFloat(fila.querySelector('[name*="[precio]"]').value) || 0;
        const subtotal = cantidad * precio;
        fila.querySelector('.subtotal').textContent = `$${subtotal.toFixed(2)}`;
        total += subtotal;
    });

    const envio = parseFloat(document.querySelector('[name="costo_envio"]').value) || 0;
    total += envio;

    document.getElementById('total').textContent = total.toFixed(2);
}

function eliminarFila(boton) {
    boton.closest('tr').remove();
    calcularTotales();
}
</script>

</body>
</html>
