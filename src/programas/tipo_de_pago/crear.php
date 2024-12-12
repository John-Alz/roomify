<?php
include("../../conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 
    $tipo_pago = $_POST['tipo_pago'];


    $sentencia = $conexion->prepare("INSERT INTO metodo_pago (tipo_pago) 
                                     VALUES (:tipo_pago)");

    $sentencia->bindParam(':tipo_pago', $tipo_pago);

    // Ejecutar la consulta
    if ($sentencia->execute()) {
        echo "Método de pago creado correctamente.";
        header("Location: index.php"); // Redirigir a index.php después de crear el método de pago
        exit(); // Asegura que no se ejecute más código
    } else {
        echo "Error al crear el método de pago.";
    }
}
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear Método de Pago</title>
    <link rel="shortcut icon" type="image/png" href="../../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../../assets/css/styles.min.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="./index.html" class="text-nowrap logo-img">
                        <img src="../../assets/images/logos/roomify-logo.svg" width="180" alt="" />
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
            </div>
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
                </div>
            </header>
            <!--  Header End -->
            <div class="container-fluid">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Crear Nuevo Método de Pago</h5>
                    <form method="POST" class="mt-6">
                        <div class="d-flex gap-4 mb-3">
                            <div class="w-50">
                                <label for="tipo_pago" class="form-label">Tipo de Pago</label>
                                <select class="form-control" id="tipo_pago" name="tipo_pago" required>
                                    <option value="Tarjeta de Crédito">Tarjeta de Crédito</option>
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Transferencia Bancaria">Transferencia Bancaria</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary text-white">Crear Método de Pago</button>
                            <button type="button" class="btn btn-danger" onclick="window.location.href='index.php';">Cancelar</button>
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