<?php
include("../../conexion.php");

if (isset($_GET["txtID"])) {
    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";
    $sentencia = $conexion->prepare("DELETE FROM habitaciones WHERE id_habitacion = :id_habitacion");
    $sentencia->bindParam(':id_habitacion', $txtID, PDO::PARAM_INT);
    $sentencia->execute();
    header("Location:index.php");
    exit();
}

// Consulta SQL
$sentencia = $conexion->prepare("
    SELECT 
        h.id_habitacion, 
        h.tipo_habitacion_id, 
        h.numero_habitacion, 
        h.detalle_habitacion, 
        h.disponibilidad_habitacion, 
        h.capacidad_habitacion, 
        h.costo_habitacion 
    FROM habitaciones h
");

$sentencia->execute();
$resultado_habitaciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modernize Free</title>
    <link rel="shortcut icon" type="image/png" href="../../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../../assets/css/styles.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="./index.html" class="text-nowrap logo-img">
                    <img src="../../assets/images/logos\roomify-logo.svg" width="180" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="../../rooms/index.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="../reservas.html" aria-expanded="false">
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
                            <a class="sidebar-link" href="../huespedes/index.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user"></i>
                                </span>
                                <span class="hide-menu">Huespedes</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="#" aria-expanded="false">
                                <span>
                                    <i class="ti ti-file-check"></i>
                                </span>
                                <span class="hide-menu">Amenidades</span>
                            </a>
                        </li>


                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
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
                             <!-- Barra de búsqueda y acciones -->
    
        <div class="actions d-flex align-items-center">
            <a href="#" class="me-3">
                <i class="fas fa-bell fs-4"></i>
            </a>
            <a href="#" class="profile-icon">
                <img src="../../assets/images/logos/Ellipse.png" alt="Perfil" class="rounded-circle" width="40">
            </a>
        </div>
    </div>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">My Profile</p>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-mail fs-6"></i>
                                            <p class="mb-0 fs-3">My Account</p>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-list-check fs-6"></i>
                                            <p class="mb-0 fs-3">My Task</p>
                                        </a>
                                        <a href="./authentication-login.html"
                                            class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">
                <div class="container-content">
                <div class="container-fluid">
                <div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <!-- Título y subtítulos -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                    <h5 class="fw-bold" style="font-size: 2.4rem; position: relative; top: -27px; font-weight: 800;">
                        Habitaciones
                    </h5>

                        <div class="d-flex align-items-center">
                            <a href="#" class="text-primary text-decoration-underline me-3 fw-semibold" style="font-size: 0.7rem;">
                                Todas las habitaciones disponibles (49)
                            </a>
                            <span class="fw-semibold text-dark me-3" style="font-size: 0.7rem;">Habitaciones disponibles (10)</span>
                            <span class="fw-semibold text-dark" style="font-size: 0.7rem;">Habitaciones reservadas (39)</span>
                        </div>
                    </div>
                    <!-- Botones -->
                    <div class="d-flex align-items-center">
                        <button class="btn btn-light border me-2 d-flex align-items-center px-2 py-1" style="font-size: 0.85rem; color: #6c757d;">
                            <i class="fas fa-filter me-2" style="font-size: 0.5rem; color: #6c757d;"></i> Filtros
                        </button>
                        <button class="btn btn-primary text-white d-flex align-items-center px-3 py-1" style="font-size: 0.85rem;">
                        <a href="crear.php" class="btn btn-primary text-white d-flex align-items-center px-3 py-1" style="font-size: 0.85rem;">
                        <i class="fas fa-plus me-2" style="font-size: 0.9rem;"></i> Crear Habitacion
                        </a>

                        </button>
                    </div>
                </div>
                            <table class="table text-nowrap mb-0 align-middle">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th>Id</th>
                                        <th>Tipo Habitación</th>
                                        <th>No. Habitación</th>
                                        <th>Detalle</th>
                                        <th>Disponibilidad</th>
                                        <th>Capacidad</th>
                                        <th>Precio Noche</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($resultado_habitaciones as $habitacion) { ?>
                                        <tr>
                                            <td><?php echo $habitacion["id_habitacion"]; ?></td>
                                            <td><?php echo $habitacion["tipo_habitacion_id"]; ?></td>
                                            <td><?php echo $habitacion["numero_habitacion"]; ?></td>
                                            <td><?php echo $habitacion["detalle_habitacion"]; ?></td>
                                            <td>
                                                <?php 
                                                $estado = $habitacion["disponibilidad_habitacion"];
                                                if ($estado === 'disponible') {
                                                    echo '<span class="badge" style="background-color: #10A760; color: white;">Disponible</span>';
                                                } elseif ($estado === 'limpieza') {
                                                    echo '<span class="badge" style="background-color: #0058ca; color: white;">Limpieza</span>';
                                                } elseif ($estado === 'reservada') {
                                                    echo '<span class="badge" style="background-color: #b10000; color: white;">Reservada</span>';
                                                } else {
                                                    echo '<span class="badge" style="background-color: #6c757d; color: white;">Sin estado</span>';
                                                }
                                                ?>
                                            </td>


                                            <td><?php echo $habitacion["capacidad_habitacion"]; ?></td>
                                            <td>$<?php echo number_format($habitacion["costo_habitacion"], 2); ?></td>
                                            <td>
                                                <a href="editar.php?txtID=<?php echo $habitacion["id_habitacion"]; ?>" class="btn btn-primary btn-sm">
                                                    <i class="fa-solid fa-pencil"></i>
                                                </a>
                                                <a href="index.php?txtID=<?php echo $habitacion["id_habitacion"]; ?>" class="btn btn-danger btn-sm">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
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
                </div>
            </div>
        </div>
    </div>
    <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/sidebarmenu.js"></script>
    <script src="../../assets/js/app.min.js"></script>
    <script src="../../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../../assets/js/dashboard.js"></script>
</body>

</html>