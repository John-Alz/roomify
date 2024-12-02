<?php
include("../../conexion.php");

$sentencia = $conexion->prepare("SELECT * FROM promociones");
$sentencia->execute();
$promociones = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Promociones</title>
    <link rel="shortcut icon" type="image/png" href="../../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../../assets/css/styles.min.css" />
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar -->
        <aside class="left-sidebar">
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="./index.html" class="text-nowrap logo-img">
                        <img src="../../assets/images/logos/dark-logo.svg" width="180" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./index.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="#" aria-expanded="false">
                                <span>
                                    <i class="ti ti-discount"></i>
                                </span>
                                <span class="hide-menu">Promociones</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/" aria-expanded="false">
                                <span>
                                    <i class="ti ti-bookmark"></i>
                                </span>
                                <span class="hide-menu">Reservas</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="../rooms/index.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-bed"></i>
                                </span>
                                <span class="hide-menu">Habitaciones</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="#" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user"></i>
                                </span>
                                <span class="hide-menu">Huespedes</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Main wrapper -->
        <div class="body-wrapper">
            <!-- Header -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <a href="#" class="btn btn-primary">Roomify</a>
                        </ul>
                    </div>
                </nav>
            </header>

            <div class="container-fluid">
                <div class="container-content">
                    <div class="row">
                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100">
                                <div class="card-body py-2">
                                    <h4 class="card-title fw-semibold mb-4">Promociones</h4>
                                    <div class="table-responsive">
                                        <div class="btn-create">
                                            <a href="./crear.php">Agregar nueva promoción</a>
                                        </div>
                                        <table class="table text-nowrap mb-0 align-middle">
                                            <thead class="text-dark fs-4">
                                                <tr>
                                                    <th class="border-bottom-0">ID</th>
                                                    <th class="border-bottom-0">Tipo</th>
                                                    <th class="border-bottom-0">Nombre</th>
                                                    <th class="border-bottom-0">Descripción</th>
                                                    <th class="border-bottom-0">Descuento</th>
                                                    <th class="border-bottom-0">Inicio</th>
                                                    <th class="border-bottom-0">Fin</th>
                                                    <th class="border-bottom-0">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($promociones as $promocion) { ?>
                                                    <tr>
                                                        <td class="border-bottom-0"><?php echo $promocion["id_promocion"]; ?></td>
                                                        <td class="border-bottom-0"><?php echo $promocion["tp_id"]; ?></td>
                                                        <td class="border-bottom-0"><?php echo $promocion["nombre_promocion"]; ?></td>
                                                        <td class="border-bottom-0"><?php echo $promocion["descripcion"]; ?></td>
                                                        <td class="border-bottom-0"><?php echo $promocion["descuento"] * 100; ?>%</td>
                                                        <td class="border-bottom-0"><?php echo $promocion["fecha_incio_promocion"]; ?></td>
                                                        <td class="border-bottom-0"><?php echo $promocion["fecha_fin_promocion"]; ?></td>
                                                        <td class="border-bottom-0">
                                                            <a href="editar.php?id=<?php echo $promocion["id_promocion"]; ?>" class="badge bg-warning rounded-3">Editar</a>
                                                            <a href="eliminar.php?id=<?php echo $promocion["id_promocion"]; ?>" class="badge bg-danger rounded-3" onclick="return confirm('¿Seguro que deseas eliminar esta promoción?')">Eliminar</a>
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
</body>

</html>
