<?php
include("../../conexion.php");


if (isset($_GET["txtID"])) {
    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";
    $sentencia = $conexion->prepare("DELETE FROM servicios_adicionales WHERE id_servicio_adicional = :id");
    $sentencia->bindParam(':id', $txtID, PDO::PARAM_INT);
    $sentencia->execute();
    header("Location:index.php");
    exit;
}


$sentencia = $conexion->prepare("SELECT id_servicio_adicional, descripcion_servicio, costo, nombre FROM servicios_adicionales");
$sentencia->execute();
$resultado_servicios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Servicios Adicionales</title>
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
                       
                        <li class="sidebar-item"><a class="sidebar-link" href="../index.html">Dashboard</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="../programas/">Reservas</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="../rooms/index.php">Habitaciones</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="../huespedes/index.php">Huespedes</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="../amenidades.html">Amenidades</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="../promo/index.php">Promociones</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="../usuarios/index.php">Usuarios</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="../tipo_habitacion/index.php">Tipo de habitacion</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="../tipo_de_pago/index.php">Metodo de pago</a></li>
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
                                    <h5 class="card-title fw-semibold mb-4">Servicios Adicionales</h5>
                                    <div class="btn-create">
                                        <a href="../amenidades/crear.php" class="btn btn-primary text-white">Crear nuevo servicio adicional</a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table text-nowrap mb-0 align-middle">
                                            <thead class="text-dark fs-4">
                                                <tr>
                                                    <th class="border-bottom-0">Id</th>
                                                    <th class="border-bottom-0">Nombre</th>
                                                    <th class="border-bottom-0">Descripción</th>
                                                    <th class="border-bottom-0">Costo</th>
                                                    <th class="border-bottom-0">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($resultado_servicios as $value) { ?>
                                                    <tr>
                                                        <td class="border-bottom-0"><?php echo $value["id_servicio_adicional"] ?></td>
                                                        <td class="border-bottom-0"><?php echo $value["nombre"] ?></td>
                                                        <td class="border-bottom-0"><?php echo $value["descripcion_servicio"] ?></td>
                                                        <td class="border-bottom-0">$<?php echo $value["costo"] ?></td>
                                                        <td class="border-bottom-0">
                                                            <!-- Enlace de edición -->
                                                            <a href="edit.php?id=<?php echo $value["id_servicio_adicional"]; ?>" class="badge bg-warning rounded-3 fw-semibold">Editar</a>
                                                            <!-- Enlace de eliminación -->
                                                            <a href="index.php?txtID=<?php echo $value["id_servicio_adicional"] ?>" class="badge bg-danger rounded-3 fw-semibold">Eliminar</a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
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