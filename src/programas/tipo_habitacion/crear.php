<?php
include("../../conexion.php");

// Procesar el formulario de creación
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo_habitacion = $_POST["tipo_habitacion"];
    $num_camas = $_POST["num_camas"];
    $descripcion_tipo_habitacion = $_POST["descripcion_tipo_habitacion"];

    // Insertar nuevo tipo de habitación en la base de datos
    $sentencia = $conexion->prepare("INSERT INTO tipos_habitacion (tipo_habitacion, num_camas, descripcion_tipo_habitacion) VALUES (:tipo_habitacion, :num_camas, :descripcion)");
    $sentencia->bindParam(':tipo_habitacion', $tipo_habitacion);
    $sentencia->bindParam(':num_camas', $num_camas, PDO::PARAM_INT);
    $sentencia->bindParam(':descripcion', $descripcion_tipo_habitacion);
    
    if ($sentencia->execute()) {
        header("Location:index.php");
        exit;
    } else {
        $error = "Error al crear el tipo de habitación.";
    }
}
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear Tipo de Habitación</title>
    <link rel="shortcut icon" type="image/png" href="../../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../../assets/css/styles.min.css" />
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <aside class="left-sidebar">
            <!-- Aquí va el menú lateral como en index.php -->
        </aside>

        <div class="body-wrapper">
            <header class="app-header">
                <!-- Aquí va el encabezado como en index.php -->
            </header>

            <div class="container-fluid">
                <div class="container-content">
                    <div class="row">
                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100">
                                <div class="card-body py-2">
                                    <h5 class="card-title fw-semibold mb-4">Crear Tipo de Habitación</h5>
                                    <?php if (isset($error)) { ?>
                                        <div class="alert alert-danger"><?php echo $error; ?></div>
                                    <?php } ?>
                                    <form method="POST" action="">
                                        <div class="mb-3">
                                            <label for="tipo_habitacion" class="form-label">Tipo de Habitación</label>
                                            <input type="text" name="tipo_habitacion" id="tipo_habitacion" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="num_camas" class="form-label">Número de Camas</label>
                                            <input type="number" name="num_camas" id="num_camas" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="descripcion_tipo_habitacion" class="form-label">Descripción</label>
                                            <textarea name="descripcion_tipo_habitacion" id="descripcion_tipo_habitacion" class="form-control"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Crear</button>
                                        <a href="../tipos_habitacion/index.php" class="btn btn-secondary">Cancelar</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/modernize.min.js"></script>
    <script src="../../assets/js/core.js"></script>
</body>

</html>