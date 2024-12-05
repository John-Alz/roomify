<?php
include("../../conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger datos del formulario
    $nombre = $_POST['nombre_usuario'];
    $email = $_POST['email_usuario'];
    $contrasena = $_POST['contrasena_usuario'];  // Sin encriptar
    $rol_id = $_POST['rol_id'];  // Este debe ser un id válido de la tabla roles
    $fecha_creacion_usuario = $_POST['fecha_creacion'];
    $estado_usuario = $_POST['estado_usuario'];

    // Preparar sentencia SQL
    $sentencia = $conexion->prepare("INSERT INTO usuarios (nombre_usuario, email_usuario, contrasena_usuario, rol_id, fecha_creacion_usuario, estado_usuario) 
                                    VALUES (:nombre, :email, :contrasena, :rol_id, :fecha_creacion_usuario, :estado_usuario)");

    // Vincular parámetros
    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':email', $email);
    $sentencia->bindParam(':contrasena', $contrasena);
    $sentencia->bindParam(':rol_id', $rol_id);
    $sentencia->bindParam(':fecha_creacion_usuario', $fecha_creacion_usuario);
    $sentencia->bindParam(':estado_usuario', $estado_usuario);

    // Ejecutar sentencia y redirigir
    if ($sentencia->execute()) {
        header("Location: index.php");
        exit(); // Asegúrate de usar exit después de redirigir
    } else {
        echo "Error al crear el usuario.";
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
                
    
                            <li class="nav-item dropdown">
                               
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
        <div class="card shadow-lg border-0 p-5">
    <h5 class="card-title text-center fw-semibold mb-4">Crear Usuario</h5>

    <form action="crear.php" method="POST">
        <div class="row">
            <!-- Nombre de Usuario -->
            <div class="col-md-6 mb-4">
                <label for="nombre_usuario" class="form-label text-dark">Nombre de Usuario</label>
                <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control form-control-lg rounded-pill shadow-sm" required>
            </div>

            <!-- Email de Usuario -->
            <div class="col-md-6 mb-4">
                <label for="email_usuario" class="form-label text-dark">Email</label>
                <input type="email" name="email_usuario" id="email_usuario" class="form-control form-control-lg rounded-pill shadow-sm" required>
            </div>
        </div>

        <div class="row">
            <!-- Contraseña -->
            <div class="col-md-6 mb-4">
                <label for="contrasena_usuario" class="form-label text-dark">Contraseña</label>
                <input type="password" name="contrasena_usuario" id="contrasena_usuario" class="form-control form-control-lg rounded-pill shadow-sm" required>
            </div>

            <!-- Rol -->
            <div class="col-md-6 mb-4">
                <label for="rol_id" class="form-label text-dark">Rol</label>
                <select name="rol_id" id="rol_id" class="form-select form-select-lg rounded-pill shadow-sm" required>
                    <?php
                    // Consulta para obtener los roles
                    $sentencia = $conexion->query("SELECT * FROM roles");
                    while ($rol = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $rol['id_rol'] . "'>" . $rol['nombre_rol'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="row">
            <!-- Fecha de Creación -->
            <div class="col-md-6 mb-4">
                <label for="fecha_creacion" class="form-label text-dark">Fecha de Creación</label>
                <input type="date" name="fecha_creacion" id="fecha_creacion" class="form-control form-control-lg rounded-pill shadow-sm" required>
            </div>

            <!-- Estado -->
            <div class="col-md-6 mb-4">
                <label for="estado_usuario" class="form-label text-dark">Estado</label>
                <select name="estado_usuario" id="estado_usuario" class="form-select form-select-lg rounded-pill shadow-sm" required>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
            </div>
        </div>

        <!-- Botones -->
        <div class="d-flex justify-content-center gap-4 mt-4">
            <button type="submit" class="btn btn-success btn-lg px-5 py-2 rounded-pill shadow-sm">Guardar</button>
            <button type="button" class="btn btn-danger btn-lg px-5 py-2 rounded-pill shadow-sm">Cancelar</button>
        </div>
    </form>
</div>

<!-- Estilos Adicionales -->
<style>
    .card {
        background: #f8f9fa;
        border-radius: 20px;
    }

    .form-control, .form-select {
        transition: all 0.3s ease-in-out;
    }

    .form-control:focus, .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
    }

    .btn {
        transition: all 0.3s ease-in-out;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
    }

    .btn:active {
        transform: translateY(0);
    }

    .row {
        margin-bottom: 10px;
    }
</style>

    <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/sidebarmenu.js"></script>
    <script src="../../assets/js/app.min.js"></script>
    <script src="../../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../../assets/js/dashboard.js"></script>
</body>

</html>