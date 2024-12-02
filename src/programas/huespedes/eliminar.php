<?php
include("../../conexion.php");
// Verifica si el ID está en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID de cliente no proporcionado.";
    exit; // Detiene la ejecución si no se proporciona el ID
}

$id_cliente = $_GET['id']; // Captura el ID de la URL

// Verifica que el ID sea un número válido
if (!is_numeric($id_cliente)) {
    echo "ID no válido.";
    exit; // Detiene la ejecución si el ID no es un número
}

// Eliminar el cliente
$sentencia = $conexion->prepare("DELETE FROM clientes WHERE id_cliente = :id_cliente");
$sentencia->bindParam(':id_cliente', $id_cliente);

if ($sentencia->execute()) {
    header("Location: index.php"); // Redirige a la lista de clientes
    exit;
} else {
    echo "Error al eliminar el cliente.";
}
?>
