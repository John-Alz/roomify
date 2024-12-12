<?php
include("../../conexion.php");

if (isset($_GET['id'])) {
    $id_servicio_adicional = $_GET['id'];

    try {
        // Prepare and execute the DELETE query
        $stmt = $conexion->prepare("DELETE FROM servicios_adicionales WHERE id_servicio_adicional = :id");
        $stmt->bindParam(':id', $id_servicio_adicional);

        // Execute the query and handle the result
        if ($stmt->execute()) {
            // Successful deletion, redirect to index.php
            header("Location: index.php");
            exit();
        } else {
            // Error occurred during deletion
            echo "Error deleting service: " . $stmt->errorInfo()[2];
        }
    } catch (PDOException $e) {
        // General database error
        echo "Database error: " . $e->getMessage();
    }
} else {
    echo "Invalid ID.";
}
?>