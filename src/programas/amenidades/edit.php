<?php
include("../../conexion.php");

// Verificar si se ha recibido el ID del servicio
if (isset($_GET['id'])) {
    $id_servicio_adicional = $_GET['id'];

    // Obtener los detalles del servicio
    $sentencia = $conexion->prepare("SELECT * FROM servicios_adicionales WHERE id_servicio_adicional = :id");
    $sentencia->bindParam(':id', $id_servicio_adicional, PDO::PARAM_INT);
    $sentencia->execute();
    $servicio = $sentencia->fetch(PDO::FETCH_ASSOC);
}

// Actualizar servicio
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_servicio_adicional = $_POST['id_servicio_adicional'];
    $nombre = $_POST['nombre'];
    $descripcion_servicio = $_POST['descripcion_servicio'];
    $costo = $_POST['costo'];

    // Actualizar la base de datos con los nuevos datos
    $sentencia = $conexion->prepare("UPDATE servicios_adicionales SET nombre = :nombre, descripcion_servicio = :descripcion_servicio, costo = :costo WHERE id_servicio_adicional = :id");
    $sentencia->bindParam(':id', $id_servicio_adicional, PDO::PARAM_INT);
    $sentencia->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $sentencia->bindParam(':descripcion_servicio', $descripcion_servicio, PDO::PARAM_STR);
    $sentencia->bindParam(':costo', $costo, PDO::PARAM_STR);
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
    <title>Editar Servicio Adicional</title>
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
                                    <h5 class="card-title fw-semibold mb-4">Editar Servicio Adicional</h5>
                                    <form method="POST" action="edit.php">
                                        <input type="hidden" name="id_servicio_adicional" value="<?php echo $servicio['id_servicio_adicional']; ?>">

                                        <div class="mb-3">
                                            <label for="nombre" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $servicio['nombre']; ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="descripcion_servicio" class="form-label">Descripción</label>
                                            <textarea class="form-control" id="descripcion_servicio" name="descripcion_servicio" rows="4" required><?php echo $servicio['descripcion_servicio']; ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="costo" class="form-label">Costo</label>
                                            <input type="number" step="0.01" class="form-control" id="costo" name="costo" value="<?php echo $servicio['costo']; ?>" required>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                        <a href="index.php" class="btn btn-secondary">Cancelar</a>
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
