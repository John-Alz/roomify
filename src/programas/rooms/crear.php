<?php
include("../../conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger datos del formulario
    $tipo_habitacion_id = $_POST["tipo_habitacion_id"];
    $numero_habitacion = $_POST["numero_habitacion"];
    $detalle_habitacion = $_POST["detalle_habitacion"];
    $disponibilidad_habitacion = $_POST["disponibilidad_habitacion"];
    $capacidad_habitacion = $_POST["capacidad_habitacion"];
    $costo_habitacion = $_POST["costo_habitacion"];
    
    // Preparar sentencia SQL para insertar
    $sentencia = $conexion->prepare("INSERT INTO habitaciones (tipo_habitacion_id, numero_habitacion, detalle_habitacion, disponibilidad_habitacion, capacidad_habitacion, costo_habitacion) 
                                      VALUES (:tipo_habitacion_id, :numero_habitacion, :detalle_habitacion, :disponibilidad_habitacion, :capacidad_habitacion, :costo_habitacion)");
    $sentencia->bindParam(':tipo_habitacion_id', $tipo_habitacion_id);
    $sentencia->bindParam(':numero_habitacion', $numero_habitacion);
    $sentencia->bindParam(':detalle_habitacion', $detalle_habitacion);
    $sentencia->bindParam(':disponibilidad_habitacion', $disponibilidad_habitacion);
    $sentencia->bindParam(':capacidad_habitacion', $capacidad_habitacion);
    $sentencia->bindParam(':costo_habitacion', $costo_habitacion);
    
    // Ejecutar la consulta
    if ($sentencia->execute()) {
        header("Location: index.php");
        exit();
    } else {
        $error = "Error al guardar la habitación.";
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
    <h5 class="card-title fw-semibold mb-4">
        <?php echo isset($habitacion) ? '<h5 class="fw-bold" style="font-size: 2.4rem; position: relative; top: -27px; font-weight: 800;">
    Editar una habitacion
</h5>
' : '<h5 class="fw-bold" style="font-size: 2.4rem; position: relative; top: -27px; font-weight: 800;">
    Agregar nueva habitacion
</h5>
'; ?>
    </h5>

    <!-- Sección de imágenes y botón de agregar imagen -->
    <div class="mb-4">
        <div class="d-flex flex-wrap gap-3">
            <!-- Área de visualización de imágenes -->
            <div class="d-flex align-items-center gap-3">
                <img src="../../assets/images/rooms-img/Rectangle 1.png" alt="Imagen Habitación" class="img-fluid rounded" style="width: 150px; height: auto;">
                <img src="../../assets/images/rooms-img/Rectangle 2.png" alt="Imagen Habitación" class="img-fluid rounded" style="width: 150px; height: auto;">
                <img src="../../assets/images/rooms-img/Rectangle 3.png" alt="Imagen Habitación" class="img-fluid rounded" style="width: 150px; height: auto;">
                <img src="../../assets/images/rooms-img/Image input.png" alt="Imagen Habitación" class="img-fluid rounded" style="width: 150px; height: auto;">
            </div>
        </div>
    </div>

    <!-- Formulario de Creación o Edición de Habitación -->
    <form action="index.php" method="POST" enctype="multipart/form-data">
        <!-- Se agrega un campo oculto para identificar si es creación o edición -->
        <input type="hidden" name="accion" value="<?php echo isset($habitacion) ? 'editar' : 'crear'; ?>">

        <!-- Si estamos editando, se pasa el id de la habitación -->
        <input type="hidden" name="id_habitacion" value="<?php echo isset($habitacion) ? $habitacion['id_habitacion'] : ''; ?>">

        <div class="d-flex gap-4 mb-3">
            <div class="w-50">
                <label for="numero_habitacion" class="form-label">Número de Habitación</label>
                <input type="text" class="form-control" id="numero_habitacion" name="numero_habitacion" 
                value="<?php echo isset($habitacion) ? $habitacion['numero_habitacion'] : ''; ?>" required>
            </div>
            <div class="w-50">
                <label for="estado_reserva" class="form-label">Estado de Reserva</label>
                <select class="form-select" id="estado_reserva" name="estado_reserva" required>
                    <option value="Disponible" <?php echo (isset($habitacion) && $habitacion['estado_reserva'] == 'Disponible') ? 'selected' : ''; ?>>Disponible</option>
                    <option value="Reservada" <?php echo (isset($habitacion) && $habitacion['estado_reserva'] == 'Reservada') ? 'selected' : ''; ?>>Reservada</option>
                    <option value="Limpieza" <?php echo (isset($habitacion) && $habitacion['estado_reserva'] == 'Limpieza') ? 'selected' : ''; ?>>Limpieza</option>
                </select>
            </div>
        </div>

        <div class="d-flex gap-4 mb-3">
            <div class="w-50">
                <label for="tipo_habitacion" class="form-label">Tipo de Habitación</label>
                <input type="text" class="form-control" id="tipo_habitacion" name="tipo_habitacion" 
                value="<?php echo isset($habitacion) ? $habitacion['tipo_habitacion'] : ''; ?>" required>
            </div>
            <div class="w-50">
                <label for="capacidad" class="form-label">Capacidad</label>
                <input type="number" class="form-control" id="capacidad" name="capacidad" 
                value="<?php echo isset($habitacion) ? $habitacion['capacidad'] : ''; ?>" required>
            </div>
        </div>

        <div class="d-flex gap-4 mb-3">
            <div class="w-50">
                <label for="precio_noche" class="form-label">Precio por Noche</label>
                <input type="number" class="form-control" id="precio_noche" name="precio_noche" 
                value="<?php echo isset($habitacion) ? $habitacion['precio_noche'] : ''; ?>" required>
            </div>

        </div>

        <div class="mb-3">
            <label for="descripcion_habitacion" class="form-label">Descripción de la Habitación</label>
            <textarea class="form-control" id="descripcion_habitacion" name="descripcion_habitacion" rows="4" required>
                <?php echo isset($habitacion) ? $habitacion['descripcion_habitacion'] : ''; ?>
            </textarea>
        </div>

        <div class="mb-3">
            <label for="amenidades" class="form-label">Amenidades</label>
            <input type="text" class="form-control" id="amenidades" name="amenidades" 
            value="<?php echo isset($habitacion) ? $habitacion['amenidades'] : ''; ?>" required>
        </div>

        <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary text-white d-flex align-items-center px-3 py-1" style="font-size: 0.85rem;">
    <i class="fas fa-plus me-2" style="font-size: 0.9rem;"></i> 
    <?php echo isset($habitacion) ? 'Guardar Cambios' : 'Crear Habitación'; ?>
</button>

            <button type="button" class="btn btn-danger">Cancelar</button>
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