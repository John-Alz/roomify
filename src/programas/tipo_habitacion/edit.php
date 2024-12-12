<?php
include("../../conexion.php");

// Verificar si se ha recibido el ID del tipo de habitación
if (isset($_GET['id'])) {
    $id_tipo_habitacion = $_GET['id'];

    // Obtener los detalles del tipo de habitación
    $sentencia = $conexion->prepare("SELECT * FROM tipos_habitacion WHERE id_tipo_habitacion = :id");
    $sentencia->bindParam(':id', $id_tipo_habitacion, PDO::PARAM_INT);
    $sentencia->execute();
    $tipo_habitacion = $sentencia->fetch(PDO::FETCH_ASSOC);
}

// Actualizar tipo de habitación
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_tipo_habitacion = $_POST['id_tipo_habitacion'];
    $tipo_habitacion_nombre = $_POST['tipo_habitacion'];
    $num_camas = $_POST['num_camas'];
    $descripcion_tipo_habitacion = $_POST['descripcion_tipo_habitacion'];

    // Actualizar la base de datos con los nuevos datos
    $sentencia = $conexion->prepare("UPDATE tipos_habitacion SET tipo_habitacion = :tipo_habitacion, num_camas = :num_camas, descripcion_tipo_habitacion = :descripcion_tipo_habitacion WHERE id_tipo_habitacion = :id");
    $sentencia->bindParam(':id', $id_tipo_habitacion, PDO::PARAM_INT);
    $sentencia->bindParam(':tipo_habitacion', $tipo_habitacion_nombre, PDO::PARAM_STR);
    $sentencia->bindParam(':num_camas', $num_camas, PDO::PARAM_INT);
    $sentencia->bindParam(':descripcion_tipo_habitacion', $descripcion_tipo_habitacion, PDO::PARAM_STR);
    $sentencia->execute();

    // Redirigir después de la actualización
    header("Location: index.php");
    exit;
}
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Tipo de Habitación</title>
    <link rel="shortcut icon" type="image/png" href="../../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../../assets/css/styles.min.css" />
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <aside class="left-sidebar">
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-center">
                    <a href="./index.html" class="text-nowrap logo-img">
                        <img src="../../assets/images/logos/roomify-logo.svg" width="180" alt="" />
                    </a>
                </div>
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <!-- Menú de navegación -->
                        <li class="sidebar-item"><a class="sidebar-link" href="../index.html">Dashboard</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="../programas/">Reservas</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="../rooms/index.php">Habitaciones</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="../huespedes/index.php">Huespedes</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="../amenidades.html">Amenidades</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="../promo/index.php">Promociones</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="../usuarios/index.php">Usuarios</a></li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="body-wrapper">
            <header class="app-header">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="search-bar d-flex align-items-center w-50">
                        <div class="input-group" style="background-color: #f2f2f2; border-radius: 8px; padding: 4px;">
                            <span class="input-group-text bg-transparent border-0">
                                <i class="fas fa-search text-dark"></i>
                            </span>
                            <input type="text" class="form-control border-0 bg-transparent text-dark" placeholder="Buscar aquí...">
                        </div>
                    </div>
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                                <div class="actions d-flex align-items-center">
                                    <a href="#" class="me-3">
                                        <i class="fas fa-bell fs-4"></i>
                                    </a>
                                    <a href="#" class="profile-icon">
                                        <img src="../../assets/images/logos/Ellipse.png" alt="Perfil" class="rounded-circle" width="40">
                                    </a>
                                </div>
                            </ul>
                        </div>
                    </nav>
                </div>
            </header>

            <div class="container-fluid">
                <div class="container-content">
                    <div class="row">
                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100">
                                <div class="card-body py-2">
                                    <h5 class="card-title fw-semibold mb-4">Editar Tipo de Habitación</h5>
                                    <?php if ($tipo_habitacion): ?>
                                        <form method="POST" action="">
                                            <input type="hidden" name="id_tipo_habitacion" value="<?php echo $tipo_habitacion['id_tipo_habitacion']; ?>">

                                            <div class="mb-3">
                                                <label for="tipo_habitacion" class="form-label">Tipo de Habitación</label>
                                                <input type="text" class="form-control" id="tipo_habitacion" name="tipo_habitacion" value="<?php echo htmlspecialchars($tipo_habitacion['tipo_habitacion']); ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="num_camas" class="form-label">Número de Camas</label>
                                                <input type="number" min=1 step=1 class="form-control" id="num_camas" name='num_camas' value="<?php echo htmlspecialchars($tipo_habitacion['num_camas']); ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for='descripcion_tipo_habitacion' class='form-label'>Descripción</label>
                                                <textarea class='form-control' id='descripcion_tipo_habitacion' name='descripcion_tipo_habitacion' rows='4' required><?php echo htmlspecialchars($tipo_habitacion['descripcion_tipo_habitacion']); ?></textarea>
                                            </div>

                                            <button type='submit' class='btn btn-primary'>Guardar Cambios</button>
                                            <a href='index.php' class='btn btn-secondary'>Cancelar</a>
                                        </form>
                                    <?php else: ?>
                                        <p>No se encontró el tipo de habitación.</p>
                                    <?php endif; ?>
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
