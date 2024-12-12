<?php

require("../../conexion.php");



// Obtener tipos de habitación
$sentencia = $conexion->prepare("SELECT * FROM clientes;");
$sentencia->execute();
$resultado_habitaciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);

print_r($_POST);

// Agregar habitación

$id = rand(10,100);

if ($_POST) {
    $cliente = (isset($_POST["cliente"])) ? $_POST["cliente"] : "";
    $fecha_reserva = (isset($_POST["fecha_reserva"])) ? $_POST["fecha_reserva"] : "";
    $estado_reserva = (isset($_POST["estado_reserva"])) ? $_POST["estado_reserva"] : "";
    $descripcion_reserva = (isset($_POST["descripcion_reserva"])) ? $_POST["descripcion_reserva"] : "";
    $check_in = (isset($_POST["check_in"])) ? $_POST["check_in"] : "";
    $check_out = (isset($_POST["check_out"])) ? $_POST["check_out"] : ""; 

    // Preparar la sentencia con parámetros dinámicos
    $sentencia = $conexion->prepare("INSERT INTO reservas (id_reserva, cliente_id, fecha_reserva, estado_reserva, descripcion_reserva, check_in_reserva, check_out_reserva) VALUES ($id, :cliente, :fecha_reserva, :estado_reserva, :descripcion_reserva, :check_in, :check_out)");

    // Asignar valores a los parámetros
    $sentencia->bindParam(':cliente', $cliente);
    $sentencia->bindParam(':fecha_reserva', $fecha_reserva);
    $sentencia->bindParam(':estado_reserva', $estado_reserva);
    $sentencia->bindParam(':descripcion_reserva', $descripcion_reserva);
    $sentencia->bindParam(':check_in', $check_in);
    $sentencia->bindParam(':check_out', $check_out);

    // Ejecutar la sentencia
    if ($sentencia->execute()) {
        echo "reserva creada correctamente.";
        header("Location: index.php");
    } else {
        echo "Error al crear la reserva.";
    }
}
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
                            <a class="sidebar-link" href="./index.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
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
        <div class="container-fluid">
        <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Crear Reserva</h5>

                    <form action="crear.php" method="POST" class="mt-6">
                        <div class="d-flex gap-4">

                        
                        <div class="w-50">
                        <div class="d-flex gap-4 mb-3">
                            <div class="w-100">
                                <label for="tp_id" class="form-label">Cliente</label>
                                <select name="cliente" id="tp_id" class="form-select" required>
                                    <?php
                                    // Consulta para obtener los tipos de habitación
                                    $sentencia = $conexion->query("SELECT * FROM clientes");
                                    while ($cliente = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value='" . $cliente['id_cliente'] . "'>" . $cliente['nombre_cliente'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex gap-4 mb-3">
                            <div class="w-100">
                                <label for="nombre_promocion" class="form-label">Fecha de reserva</label>
                                <input type="date" name="fecha_reserva" id="nombre_promocion" class="form-control"
                                    required>
                            </div>
                        </div>

                        <div class="d-flex gap-4 mb-3">
                            <div class="w-100">
                                <label for="descripcion" class="form-label">Estado Reserva</label>
                                <input type="text" name="estado_reserva" id="descripcion" class="form-control" required>
                            </div>
                        </div>
                        </div>

                        <div class=" gap-4 mb-3 w-50">
                            <div >
                                <label for="fecha_inicio" class="form-label">Descripcion reserva</label>
                                <textarea name="descripcion_reserva"  class="form-control"> </textarea>
                            </div>
                            <div>
                                <label for="fecha_fin" class="form-label">Check-in</label>
                                <input type="date" name="check_in" id="fecha_fin" class="form-control" required>
                            </div>
                            <div>
                                <label for="fecha_fin" class="form-label">Check-out</label>
                                <input type="date" name="check_out" id="fecha_fin" class="form-control" required>
                            </div>
                        </div>
                        </div>


                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary text-white">Guardar</button>
                            <button type="button" class="btn btn-danger">Cancelar</button>
                        </div>
                    </form>
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