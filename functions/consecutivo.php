<?php
function obtenerConsecutivo($conn) {
    $conn->query("START TRANSACTION");

    $sqlSelect = "SELECT ultimo_numero FROM consecutivos WHERE tipo_documento = 'general'";
    $stmt = $conn->prepare($sqlSelect);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        $stmt->close();
        $conn->query("ROLLBACK");
        die("❌ No se encontró el consecutivo general.");
    }

    // ✅ Inicialización para evitar advertencia de Intelephense
    $ultimoNumero = 0;

    $stmt->bind_result($ultimoNumero);
    $stmt->fetch();
    $stmt->close();

    $nuevoNumero = (int)$ultimoNumero + 1;

    $sqlUpdate = "UPDATE consecutivos SET ultimo_numero = ? WHERE tipo_documento = 'general'";
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->bind_param("i", $nuevoNumero);
    $stmt->execute();
    $stmt->close();

    $conn->query("COMMIT");

    return $nuevoNumero;
}
?>
