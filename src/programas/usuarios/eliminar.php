<?php
include("../../conexion.php");

if (!isset($_GET['id_usuario']) || empty($_GET['id_usuario'])) {
    echo "ID de usuario no proporcionado.";
    exit;
}

$id_usuario = $_GET['id_usuario'];

if (!is_numeric($id_usuario)) {
    echo "ID no válido.";
    exit;
}

$sentencia = $conexion->prepare("DELETE FROM usuarios WHERE id_usuario = :id_usuario");
$sentencia->bindParam(':id_usuario', $id_usuario);

if ($sentencia->execute()) {
    header("Location: index.php");
} else {
    echo "Error al eliminar el usuario.";
}
?>
