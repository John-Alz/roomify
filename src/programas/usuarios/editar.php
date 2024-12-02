<?php
include("../../conexion.php");

// Verifica si el ID se encuentra en la URL
if (!isset($_GET['id_usuario']) || empty($_GET['id_usuario'])) {
    echo "ID de usuario no proporcionado. Valor de id_usuario: " . (isset($_GET['id_usuario']) ? $_GET['id_usuario'] : 'No está definido');
    exit; // Detiene la ejecución si no se proporciona el ID
}

$id_usuario = $_GET['id_usuario']; // Captura el ID de la URL
echo("id =" . $id_usuario);

// Verifica que el ID sea un número válido
if (!is_numeric($id_usuario)) {
    echo "ID no válido.";
    exit; // Detiene la ejecución si el ID no es un número
}

// Consulta al usuario basado en el ID
$sentencia = $conexion->prepare("SELECT * FROM usuarios WHERE id_usuario = :id_usuario");
$sentencia->bindParam(':id_usuario', $id_usuario);
$sentencia->execute();
$usuario = $sentencia->fetch(PDO::FETCH_ASSOC);

// Verifica si el usuario existe
if (!$usuario) {
    echo "Usuario no encontrado.";
    exit; // Detiene la ejecución si no se encuentra el usuario
}

// Actualiza el usuario cuando se envíe el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre_usuario'];
    $email = $_POST['email_usuario'];
    $contrasena_usuario = $_POST['contrasena_usuario'];
    $rol_id = $_POST['rol_id'];
    $fecha_creacion = $_POST['fecha_creacion_usuario'];
    $estado = $_POST['estado_usuario'];

    // Crea una nueva consulta para actualizar al usuario
    $sentencia = $conexion->prepare("UPDATE usuarios SET 
        nombre_usuario = :nombre, 
        email_usuario = :email, 
        contrasena_usuario = :contrasena, 
        rol_id = :rol_id,
        fecha_creacion_usuario = :fecha_creacion, 
        estado_usuario = :estado
        WHERE id_usuario = :id_usuario");

    // Enlaza los parámetros de la consulta con los valores del formulario
    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':email', $email);
    $sentencia->bindParam(':contrasena', $contrasena_usuario);
    $sentencia->bindParam(':rol_id', $rol_id);
    $sentencia->bindParam(':fecha_creacion', $fecha_creacion);
    $sentencia->bindParam(':estado', $estado);
    $sentencia->bindParam(':id_usuario', $id_usuario);

    // Ejecuta la consulta y redirige si es exitosa
    if ($sentencia->execute()) {
        header("Location: index.php"); // Redirige a la lista de usuarios
        exit;
    } else {
        echo "Error al actualizar el usuario.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <main class="w-full h-screen flex justify-center">
        <section class="w-[80%] bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-center text-2xl font-bold mb-4">Editar Usuario</h2>
            <form method="POST">
                <div class="mb-4">
                    <label for="nombre_usuario" class="block text-sm font-semibold text-gray-700">Nombre:</label>
                    <input type="text" id="nombre_usuario" name="nombre_usuario" value="<?php echo htmlspecialchars($usuario['nombre_usuario']); ?>" required class="w-full p-2 mt-2 border border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label for="email_usuario" class="block text-sm font-semibold text-gray-700">Email:</label>
                    <input type="email" id="email_usuario" name="email_usuario" value="<?php echo htmlspecialchars($usuario['email_usuario']); ?>" required class="w-full p-2 mt-2 border border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label for="contrasena_usuario" class="block text-sm font-semibold text-gray-700">Contraseña:</label>
                    <input type="password" id="contrasena_usuario" name="contrasena_usuario" value="<?php echo htmlspecialchars($usuario['contrasena_usuario']); ?>" required class="w-full p-2 mt-2 border border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label for="rol_id" class="block text-sm font-semibold text-gray-700">Rol:</label>
                    <select id="rol_id" name="rol_id" required class="w-full p-2 mt-2 border border-gray-300 rounded-md">
                        <?php
                        $consulta_roles = $conexion->query("SELECT id_rol, nombre_rol FROM roles");
                        while ($rol = $consulta_roles->fetch(PDO::FETCH_ASSOC)) {
                            // Compara el rol actual y selecciona el adecuado
                            $selected = ($usuario['rol_id'] == $rol['id_rol']) ? 'selected' : '';
                            echo '<option value="' . htmlspecialchars($rol['id_rol']) . '" ' . $selected . '>' . htmlspecialchars($rol['nombre_rol']) . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="fecha_creacion_usuario" class="block text-sm font-semibold text-gray-700">Fecha de Creación:</label>
                    <input type="date" id="fecha_creacion_usuario" name="fecha_creacion_usuario" value="<?php echo htmlspecialchars($usuario['fecha_creacion_usuario']); ?>" required class="w-full p-2 mt-2 border border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label for="estado_usuario" class="block text-sm font-semibold text-gray-700">Estado:</label>
                    <select id="estado_usuario" name="estado_usuario" required class="w-full p-2 mt-2 border border-gray-300 rounded-md">
                        <option value="activo" <?php if ($usuario['estado_usuario'] == 'activo') echo 'selected'; ?>>Activo</option>
                        <option value="inactivo" <?php if ($usuario['estado_usuario'] == 'inactivo') echo 'selected'; ?>>Inactivo</option>
                    </select>
                </div>

                <button type="submit" class="w-full py-2 mt-4 bg-green-500 text-white py-2 px-4 rounded-lg">Guardar Cambios</button>
            </form>
        </section>
    </main>
</body>
</html>
