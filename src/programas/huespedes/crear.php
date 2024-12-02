<?php
include("../../conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre_cliente'];
    $email = $_POST['email_cliente'];
    $telefono = $_POST['telefono_cliente'];
    $direccion = $_POST['direccion_cliente'];
    $fecha_nacimiento = $_POST['fecha_nacimiento_cliente'];  // Fecha de nacimiento
    $fecha_registro = $_POST['fecha_registro_cliente'];  // Fecha de registro

    $sentencia = $conexion->prepare("INSERT INTO clientes (nombre_cliente, email_cliente, telefono_cliente, direccion_cliente, fecha_nacimiento_cliente, fecha_registro_cliente) 
                                    VALUES (:nombre, :email, :telefono, :direccion, :fecha_nacimiento, :fecha_registro)");

    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':email', $email);
    $sentencia->bindParam(':telefono', $telefono);
    $sentencia->bindParam(':direccion', $direccion);
    $sentencia->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $sentencia->bindParam(':fecha_registro', $fecha_registro);

    if ($sentencia->execute()) {
        header("Location: index.php");
    } else {
        echo "Error al crear el cliente.";
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cliente</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <main class="w-full h-screen flex justify-center">
        <section class="w-[80%] bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-center text-2xl font-bold">Crear Cliente</h2>
            <form action="crear.php" method="POST" class="mt-6">
                <div class="mb-4">
                    <label for="nombre_cliente" class="block">Nombre</label>
                    <input type="text" name="nombre_cliente" id="nombre_cliente" class="w-full border rounded-lg p-2" required>
                </div>
                <div class="mb-4">
                    <label for="email_cliente" class="block">Email</label>
                    <input type="email" name="email_cliente" id="email_cliente" class="w-full border rounded-lg p-2" required>
                </div>
                <div class="mb-4">
                    <label for="telefono_cliente" class="block">Teléfono</label>
                    <input type="text" name="telefono_cliente" id="telefono_cliente" class="w-full border rounded-lg p-2" required>
                </div>
                <div class="mb-4">
                    <label for="direccion_cliente" class="block">Dirección</label>
                    <input type="text" name="direccion_cliente" id="direccion_cliente" class="w-full border rounded-lg p-2" required>
                </div>
                <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-lg w-full">Crear Cliente</button>
            </form>
        </section>
    </main>
</body>
</html>
