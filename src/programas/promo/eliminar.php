<?php
include("../../conexion.php");

if (isset($_GET['id'])) {
    $id_promocion = $_GET['id'];

    // Primero, verificamos si la promoción existe
    $sentencia = $conexion->prepare("SELECT * FROM promociones WHERE id_promocion = :id_promocion");
    $sentencia->bindParam(':id_promocion', $id_promocion);
    $sentencia->execute();
    $promocion = $sentencia->fetch(PDO::FETCH_ASSOC);

    if ($promocion) {
        // Si la promoción existe, procedemos a eliminarla
        $sentencia = $conexion->prepare("DELETE FROM promociones WHERE id_promocion = :id_promocion");
        $sentencia->bindParam(':id_promocion', $id_promocion);

        if ($sentencia->execute()) {
            echo "Promoción eliminada correctamente.";
            header("Location: index.php"); // Redirigir de vuelta a la lista de promociones
        } else {
            echo "Error al eliminar la promoción.";
        }
    } else {
        echo "Promoción no encontrada.";
    }
} else {
    echo "ID de promoción no especificado.";
}
?>
