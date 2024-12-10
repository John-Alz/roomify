<?php
include("../../conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sentencia = $conexion->prepare("SELECT * FROM servicios_adicionales WHERE id_servicio_adicional = :id");
    $sentencia->bindParam(':id', $id);
    $sentencia->execute();
    $servicio = $sentencia->fetch(PDO::FETCH_ASSOC);

    if (!$servicio) {
        echo "Servicio no encontrado.";
        exit;
    }
} else {
    echo "ID no especificado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion_servicio'];
    $costo = $_POST['costo'];

    // Actualizando el servicio
    $sentencia = $conexion->prepare("UPDATE servicios_adicionales SET 
        nombre = :nombre, 
        descripcion_servicio = :descripcion_servicio, 
        costo = :costo 
        WHERE id_servicio_adicional = :id");
    
    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':descripcion_servicio', $descripcion);
    $sentencia->bindParam(':costo', $costo);
    $sentencia->bindParam(':id', $id);

    // Ejecutar la actualización
    if ($sentencia->execute()) {
        header("Location: index.php");  // Redirigir al index después de la actualización
        exit;
    } else {
        echo "Error al actualizar el servicio.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Servicio Adicional</title>
    <link rel="stylesheet" href="../../assets/css/styles.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .form-row {
            display: flex;
            gap: 20px;
        }
        .form-group {
            width: 100%;
        }
        .btn-cancel {
            background-color: #dc3545;
        }
        .btn-cancel:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Editar Servicio</h2>
    <form method="POST">
        <div class="form-row">
            <div class="form-group">
                <label for="nombre">Nombre del Servicio</label>
                <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($servicio['nombre']); ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="descripcion_servicio">Descripción del Servicio</label>
                <textarea name="descripcion_servicio" id="descripcion_servicio" required><?php echo htmlspecialchars($servicio['descripcion_servicio']); ?></textarea>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="costo">Costo del Servicio</label>
                <input type="number" name="costo" id="costo" step="0.01" value="<?php echo htmlspecialchars($servicio['costo']); ?>" required>
            </div>
        </div>

        <div class="form-row">
            <button type="submit">Actualizar Servicio</button>
            <button type="button" class="btn-cancel" onclick="window.location.href='index.php'">Cancelar</button>
        </div>
    </form>
</div>

</body>
</html>
