<?php
include("../../conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tp_id = $_POST['tp_id'];
    $nombre_promocion = $_POST['nombre_promocion'];
    $descripcion = $_POST['descripcion'];
    $descuento = $_POST['descuento'];
    $fecha_inicio_promocion = $_POST['fecha_inicio_promocion'];
    $fecha_fin_promocion = $_POST['fecha_fin_promocion'];

    $sentencia = $conexion->prepare("INSERT INTO promociones (tp_id, nombre_promocion, descripcion, descuento, fecha_incio_promocion, fecha_fin_promocion) 
                                    VALUES (:tp_id, :nombre_promocion, :descripcion, :descuento, :fecha_inicio_promocion, :fecha_fin_promocion)");

    $sentencia->bindParam(':tp_id', $tp_id);
    $sentencia->bindParam(':nombre_promocion', $nombre_promocion);
    $sentencia->bindParam(':descripcion', $descripcion);
    $sentencia->bindParam(':descuento', $descuento);
    $sentencia->bindParam(':fecha_inicio_promocion', $fecha_inicio_promocion);
    $sentencia->bindParam(':fecha_fin_promocion', $fecha_fin_promocion);

    if ($sentencia->execute()) {
        echo "Promoción creada correctamente.";
        header("Location: index.php");
    } else {
        echo "Error al crear la promoción.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Promoción</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <main class="w-full h-screen flex justify-center">
        <section class="w-[80%] bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-center text-2xl font-bold">Crear Promoción</h2>
            <form action="crear.php" method="POST" class="mt-6">
                <div class="mb-4">
                    <label for="tp_id" class="block">Tipo de promoción</label>
                    <select name="tp_id" id="tp_id" class="w-full border rounded-lg p-2" required>
                        <?php
                        // Consulta para obtener los tipos de habitación
                        $sentencia = $conexion->query("SELECT * FROM tipos_habitacion");
                        while ($tipo = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $tipo['id_tipo_habitacion'] . "'>" . $tipo['tipo_habitacion'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="nombre_promocion" class="block">Nombre de la promoción</label>
                    <input type="text" name="nombre_promocion" id="nombre_promocion" class="w-full border rounded-lg p-2" required>
                </div>
                <div class="mb-4">
                    <label for="descripcion" class="block">Descripción</label>
                    <input type="text" name="descripcion" id="descripcion" class="w-full border rounded-lg p-2" required>
                </div>
                <div class="mb-4">
                    <label for="descuento" class="block">Descuento</label>
                    <input type="number" step="0.01" name="descuento" id="descuento" class="w-full border rounded-lg p-2" required>
                </div>
                <div class="mb-4">
                    <label for="fecha_inicio_promocion" class="block">Fecha de inicio</label>
                    <input type="date" name="fecha_inicio_promocion" id="fecha_inicio_promocion" class="w-full border rounded-lg p-2" required>
                </div>
                <div class="mb-4">
                    <label for="fecha_fin_promocion" class="block">Fecha de fin</label>
                    <input type="date" name="fecha_fin_promocion" id="fecha_fin_promocion" class="w-full border rounded-lg p-2" required>
                </div>
                <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-lg w-full">Crear Promoción</button>
            </form>
        </section>
    </main>
</body>
</html>
