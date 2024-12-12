<?php
include("../../conexion.php");

if (isset($_GET['id'])) {
    $id_servicio_adicional = $_GET['id'];

    try {

        $sentencia = $conexion->prepare("SELECT * FROM servicios_adicionales WHERE id_servicio_adicional = :id_servicio_adicional");
        $sentencia->bindParam(':id_servicio_adicional', $id_servicio_adicional);
        $sentencia->execute();
        $servicios_adicionales = $sentencia->fetch(PDO::FETCH_ASSOC);

        if ($servicios_adicionales) {
          
            $sentencia = $conexion->prepare("DELETE FROM servicios_adicionales WHERE id_servicio_adicional = :id_servicio_adicional");
            $sentencia->bindParam(':id_servicio_adicional', $id_servicio_adicional);
            $sentencia->execute();

           
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
