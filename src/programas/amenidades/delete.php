<?php
include("../../conexion.php");

if (isset($_GET['id'])) {
    $id_servicio_adicional = $_GET['id'];

    try {
        // Verificar si el servicio adicional existe
        $sentencia = $conexion->prepare("SELECT * FROM servicios_adicionales WHERE id_servicio_adicional = :id_servicio_adicional");
        $sentencia->bindParam(':id_servicio_adicional', $id_servicio_adicional);
        $sentencia->execute();
        $servicios_adicionales = $sentencia->fetch(PDO::FETCH_ASSOC);

        if ($servicios_adicionales) {
            // Si el servicio existe, proceder a eliminarlo
            $sentencia = $conexion->prepare("DELETE FROM servicios_adicionales WHERE id_servicio_adicional = :id_servicio_adicional");
            $sentencia->bindParam(':id_servicio_adicional', $id_servicio_adicional);
            $sentencia->execute();

            // Redirigir de vuelta a la lista después de eliminar
            header("Location: index.php");
            exit();
        } else {
            echo "El servicio adicional no existe.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID no válido.";
}
?>
