<?php
include("../../conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $nombre = $_POST['nombre_cliente'];
    $email = $_POST['email_cliente'];
    $telefono = $_POST['telefono_cliente'];
    $direccion = $_POST['direccion_cliente'];
    $fecha_nacimiento = $_POST['fecha_nacimiento_cliente'];  // Fecha de nacimiento
    $fecha_registro = $_POST['fecha_registro_cliente'];  // Fecha de registro
    $contrasena = $_POST['contrasena_cliente'];  // Contraseña

    // Validación de las fechas (asegúrate de que las fechas estén en formato correcto)
    $fecha_nacimiento = date('Y-m-d', strtotime($fecha_nacimiento));
    $fecha_registro = date('Y-m-d', strtotime($fecha_registro));

    // Inserción de datos en la base de datos sin encriptar la contraseña
    $sentencia = $conexion->prepare("INSERT INTO clientes (nombre_cliente, email_cliente, telefono_cliente, direccion_cliente, fecha_nacimiento_cliente, fecha_registro_cliente, contrasena_cliente) 
                                    VALUES (:nombre, :email, :telefono, :direccion, :fecha_nacimiento, :fecha_registro, :contrasena)");

    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':email', $email);
    $sentencia->bindParam(':telefono', $telefono);
    $sentencia->bindParam(':direccion', $direccion);
    $sentencia->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $sentencia->bindParam(':fecha_registro', $fecha_registro);
    $sentencia->bindParam(':contrasena', $contrasena);  // Almacenar la contraseña tal como está

    // Ejecutar la consulta
    if ($sentencia->execute()) {
        header("Location: index.php");  // Redirigir a la página de clientes
    } else {
        echo "Error al crear el cliente.";
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
    <h5 class="card-title fw-semibold mb-4">Crear Nuevo Cliente</h5>

    <!-- Formulario de Creación de Cliente -->
    <form action="crear.php" method="POST" class="mt-6">
        <div class="d-flex gap-4 mb-3">
            <div class="w-50">
                <label for="nombre_cliente" class="form-label">Nombre del Cliente</label>
                <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" required>
            </div>
            <div class="w-50">
                <label for="email_cliente" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email_cliente" name="email_cliente" required>
            </div>
        </div>

        <div class="d-flex gap-4 mb-3">
            <div class="w-50">
                <label for="contrasena_cliente" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contrasena_cliente" name="contrasena_cliente" required>
            </div>
            <div class="w-50">
                <label for="telefono_cliente" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono_cliente" name="telefono_cliente" required>
            </div>
        </div>

        <div class="d-flex gap-4 mb-3">
            <div class="w-50">
                <label for="direccion_cliente" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion_cliente" name="direccion_cliente" required>
            </div>
            <div class="w-50">
                <label for="fecha_nacimiento_cliente" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fecha_nacimiento_cliente" name="fecha_nacimiento_cliente" required>
            </div>
        </div>

        <div class="d-flex gap-4 mb-3">
            <div class="w-50">
                <label for="fecha_registro_cliente" class="form-label">Fecha de Registro</label>
                <input type="date" class="form-control" id="fecha_registro_cliente" name="fecha_registro_cliente" 
                    value="<?php echo date('Y-m-d'); ?>" required readonly>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary text-white">Crear Cliente</button>
            <button type="button" class="btn btn-danger" onclick="window.location.href='clientes.php';">Cancelar</button>
        </div>
    </form>
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





