<?php
include("../../conexion.php");

if (isset($_GET['id'])) {
    $id_metodo_pago = $_GET['id'];

    try {
        
        $sentencia = $conexion->prepare("SELECT * FROM metodo_pago WHERE id_metodo_pago = :id_metodo_pago");
        $sentencia->bindParam(':id_metodo_pago', $id_metodo_pago);
        $sentencia->execute();
        $metodo_pago = $sentencia->fetch(PDO::FETCH_ASSOC);

        if ($metodo_pago) {
      
            $sentencia = $conexion->prepare("DELETE FROM metodo_pago WHERE id_metodo_pago = :id_metodo_pago");
            $sentencia->bindParam(':id_metodo_pago', $id_metodo_pago);
            $sentencia->execute();

            header("Location: index.php");
            exit();
        } else {
            echo "El método de pago no existe.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID no válido.";
}
?>
