<?php
include("../../conexion.php");

// Verifica si el ID se encuentra en la URL
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

// Consulta al cliente basado en el ID
$sentencia = $conexion->prepare("SELECT * FROM clientes WHERE id_cliente = :id_cliente");
$sentencia->bindParam(':id_cliente', $id_cliente);
$sentencia->execute();
$cliente = $sentencia->fetch(PDO::FETCH_ASSOC);

// Verifica si el cliente existe
if (!$cliente) {
    echo "Cliente no encontrado.";
    exit; // Detiene la ejecución si no se encuentra el cliente
}

// Actualiza el cliente cuando se envíe el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre_cliente'];
    $email = $_POST['email_cliente'];
    $telefono = $_POST['telefono_cliente'];
    $direccion = $_POST['direccion_cliente'];
    $fecha_nacimiento = $_POST['fecha_nacimiento_cliente']; // Fecha de nacimiento
    $fecha_registro = $_POST['fecha_registro_cliente']; // Fecha de registro

    $sentencia = $conexion->prepare("UPDATE clientes SET 
        nombre_cliente = :nombre, 
        email_cliente = :email, 
        telefono_cliente = :telefono, 
        direccion_cliente = :direccion,
        fecha_nacimiento_cliente = :fecha_nacimiento, 
        fecha_registro_cliente = :fecha_registro
        WHERE id_cliente = :id_cliente");

    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':email', $email);
    $sentencia->bindParam(':telefono', $telefono);
    $sentencia->bindParam(':direccion', $direccion);
    $sentencia->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $sentencia->bindParam(':fecha_registro', $fecha_registro);
    $sentencia->bindParam(':id_cliente', $id_cliente);

    if ($sentencia->execute()) {
        header("Location: index.php"); // Redirige a la lista de clientes
        exit;
    } else {
        echo "Error al actualizar el cliente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <main class="w-full h-screen flex justify-center">
        <section class="w-[80%] bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-center text-2xl font-bold mb-4">Editar Cliente</h2>
            <form method="POST">
                <div class="mb-4">
                    <label for="nombre_cliente" class="block text-sm font-semibold text-gray-700">Nombre:</label>
                    <input type="text" id="nombre_cliente" name="nombre_cliente" value="<?php echo htmlspecialchars($cliente['nombre_cliente']); ?>" required class="w-full p-2 mt-2 border border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label for="email_cliente" class="block text-sm font-semibold text-gray-700">Email:</label>
                    <input type="email" id="email_cliente" name="email_cliente" value="<?php echo htmlspecialchars($cliente['email_cliente']); ?>" required class="w-full p-2 mt-2 border border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label for="telefono_cliente" class="block text-sm font-semibold text-gray-700">Teléfono:</label>
                    <input type="text" id="telefono_cliente" name="telefono_cliente" value="<?php echo htmlspecialchars($cliente['telefono_cliente']); ?>" required class="w-full p-2 mt-2 border border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label for="direccion_cliente" class="block text-sm font-semibold text-gray-700">Dirección:</label>
                    <input type="text" id="direccion_cliente" name="direccion_cliente" value="<?php echo htmlspecialchars($cliente['direccion_cliente']); ?>" required class="w-full p-2 mt-2 border border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label for="fecha_nacimiento_cliente" class="block text-sm font-semibold text-gray-700">Fecha de Nacimiento:</label>
                    <input type="date" id="fecha_nacimiento_cliente" name="fecha_nacimiento_cliente" value="<?php echo htmlspecialchars($cliente['fecha_nacimiento_cliente']); ?>" required class="w-full p-2 mt-2 border border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label for="fecha_registro_cliente" class="block text-sm font-semibold text-gray-700">Fecha de Registro:</label>
                    <input type="date" id="fecha_registro_cliente" name="fecha_registro_cliente" value="<?php echo htmlspecialchars($cliente['fecha_registro_cliente']); ?>" required class="w-full p-2 mt-2 border border-gray-300 rounded-md">
                </div>

                <button type="submit" class="w-full py-2 mt-4 bg-green-500 text-white py-2 px-4 rounded-lg">Guardar Cambios</button>
            </form>
        </section>
    </main>
</body>
</html>
