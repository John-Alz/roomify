<?php
include("../../conexion.php");

if (isset($_GET['id'])) {
    $id_servicio_adicional = $_GET['id'];

    try {

        $stmt = $conexion->prepare("DELETE FROM servicios_adicionales WHERE id_servicio_adicional = :id");
        $stmt->bindParam(':id', $id_servicio_adicional);

 
        if ($stmt->execute()) {

            header("Location: index.php");
            exit();
        } else {

            echo "Error deleting service: " . $stmt->errorInfo()[2];
        }
    } catch (PDOException $e) {

        echo "Database error: " . $e->getMessage();
    }
} else {
    echo "Invalid ID.";
}
?>