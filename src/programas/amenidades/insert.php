<?php
include("../../conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibiendo datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion_servicio'];
    $costo = $_POST['costo'];

    // Preparando la consulta para insertar
    $sentencia = $conexion->prepare("INSERT INTO servicios_adicionales (nombre, descripcion_servicio, costo) 
                                     VALUES (:nombre, :descripcion_servicio, :costo)");

    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':descripcion_servicio', $descripcion);
    $sentencia->bindParam(':costo', $costo);

    // Ejecutar la consulta
    if ($sentencia->execute()) {
        echo "Servicio creado correctamente.";
        header("Location: index.php"); // Redirigir a index.php después de crear el servicio
        exit(); // Asegura que no se ejecute más código
    } else {
        echo "Error al crear el servicio.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Servicio Adicional</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 60%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Agregar Nuevo Servicio</h2>
    <form method="POST">
        <label for="nombre">Nombre del Servicio</label>
        <input type="text" name="nombre" id="nombre" required>

        <label for="descripcion_servicio">Descripción del Servicio</label>
        <textarea name="descripcion_servicio" id="descripcion_servicio" required></textarea>

        <label for="costo">Costo del Servicio</label>
        <input type="number" name="costo" id="costo" step="0.01" required>

        <button type="submit">Crear Servicio</button>
    </form>
</div>

</body>
</html>