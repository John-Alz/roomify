<?php
include("../../conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger datos del formulario
    $nombre = $_POST['nombre_usuario'];
    $email = $_POST['email_usuario'];
    $contrasena = $_POST['contrasena_usuario'];  // Sin encriptar
    $rol_id = $_POST['rol_id'];  // Este debe ser un id válido de la tabla roles
    $fecha_creacion_usuario = $_POST['fecha_creacion'];
    $estado_usuario = $_POST['estado_usuario'];

    // Preparar sentencia SQL
    $sentencia = $conexion->prepare("INSERT INTO usuarios (nombre_usuario, email_usuario, contrasena_usuario, rol_id, fecha_creacion_usuario, estado_usuario) 
                                    VALUES (:nombre, :email, :contrasena, :rol_id, :fecha_creacion_usuario, :estado_usuario)");

    // Vincular parámetros
    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':email', $email);
    $sentencia->bindParam(':contrasena', $contrasena);
    $sentencia->bindParam(':rol_id', $rol_id);
    $sentencia->bindParam(':fecha_creacion_usuario', $fecha_creacion_usuario);
    $sentencia->bindParam(':estado_usuario', $estado_usuario);

    // Ejecutar sentencia y redirigir
    if ($sentencia->execute()) {
        header("Location: index.php");
        exit(); // Asegúrate de usar exit después de redirigir
    } else {
        echo "Error al crear el usuario.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <main class="w-full h-screen flex justify-center">
        <section class="w-[80%] bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-center text-2xl font-bold">Crear Usuario</h2>
            <form action="crear.php" method="POST" class="mt-6">
                <div class="mb-4">
                    <label for="nombre_usuario" class="block">Nombre</label>
                    <input type="text" name="nombre_usuario" id="nombre_usuario" class="w-full border rounded-lg p-2" required>
                </div>
                <div class="mb-4">
                    <label for="email_usuario" class="block">Email</label>
                    <input type="email" name="email_usuario" id="email_usuario" class="w-full border rounded-lg p-2" required>
                </div>
                <div class="mb-4">
                    <label for="contrasena_usuario" class="block">Contraseña</label>
                    <input type="password" name="contrasena_usuario" id="contrasena_usuario" class="w-full border rounded-lg p-2" required>
                </div>

                <div class="mb-4">
                    <label for="rol_id" class="block text-sm font-semibold text-gray-700">Rol:</label>
                    <select id="rol_id" name="rol_id" required class="w-full p-2 mt-2 border border-gray-300 rounded-md">
                        <?php
                        // Obtener los roles de la base de datos
                        $consulta_roles = $conexion->query("SELECT id_rol, nombre_rol FROM roles");
                        while ($rol = $consulta_roles->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="' . htmlspecialchars($rol['id_rol']) . '">' . htmlspecialchars($rol['nombre_rol']) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="fecha_creacion" class="block text-sm font-semibold text-gray-700">Fecha de creación:</label>
                    <input type="date" id="fecha_creacion" name="fecha_creacion" required class="w-full p-2 mt-2 border border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="estado_usuario" class="block text-sm font-semibold text-gray-700">Estado:</label>
                    <select id="estado_usuario" name="estado_usuario" required class="w-full p-2 mt-2 border border-gray-300 rounded-md">
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>
                    </select>
                </div>

                <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-lg w-full">Crear Usuario</button>
            </form>
        </section>
    </main>
</body>
</html>
