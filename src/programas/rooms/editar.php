<?php

require("../../conexion.php");

// Obtener tipos de habitación
$sentencia = $conexion->prepare("SELECT * FROM tipos_habitacion;");
$sentencia->execute();
$resultado_habitaciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET["txtID"])) {
    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";
    $sentencia = $conexion->prepare("SELECT h.id_habitacion, h.numero_habitacion, h.detalle_habitacion, h.disponibilidad_habitacion, tp.tipo_habitacion, h.capacidad_habitacion, h.costo_habitacion
            FROM habitaciones h
            JOIN tipos_habitacion  tp ON tp.id_tipo_habitacion = h.tipo_habitacion_id
            WHERE h.id_habitacion = :id;
");



$sentencia->bindParam(":id", $txtID);
$sentencia->execute();

$registro = $sentencia->fetch(PDO::FETCH_LAZY);

$numeroH = $registro["numero_habitacion"];
$descrpcionH = $registro["detalle_habitacion"];
$disponibilidadH = $registro["disponibilidad_habitacion"];
$capacidadH = $registro["capacidad_habitacion"];
$costoH = $registro["costo_habitacion"];
$tipoH = $registro["tipo_habitacion"];

};


if ($_POST) {
    $numeroH = (isset($_POST["numeroH"])) ? $_POST["numeroH"] : "";
    $descrpcionH = (isset($_POST["descrpcionH"])) ? $_POST["descrpcionH"] : "";
    $disponibilidadH = (isset($_POST["disponibilidadH"])) ? $_POST["disponibilidadH"] : "";
    $capacidadH = (isset($_POST["capacidadH"])) ? $_POST["capacidadH"] : "";
    $costoH = (isset($_POST["costoH"])) ? $_POST["costoH"] : "";
    $tipoH = (isset($_POST["tipoH"])) ? $_POST["tipoH"] : ""; 
    print_r($_POST);

    // Preparar la sentencia con parámetros dinámicos
    $sentencia = $conexion->prepare("UPDATE habitaciones SET tipo_habitacion_id = :tipoH, numero_habitacion = :numeroH, detalle_habitacion = :descrpcionH, disponibilidad_habitacion = :disponibilidadH, capacidad_habitacion = :capacidadH , costo_habitacion = :costoH WHERE id_habitacion = :txtID; ");

    // Asignar valores a los parámetros
    $sentencia->bindParam(':tipoH', $tipoH);
    $sentencia->bindParam(':numeroH', $numeroH);
    $sentencia->bindParam(':descrpcionH', $descrpcionH);
    $sentencia->bindParam(':disponibilidadH', $disponibilidadH);
    $sentencia->bindParam(':capacidadH', $capacidadH);
    $sentencia->bindParam(':costoH', $costoH);
    $sentencia->bindParam(':txtID', $txtID);

    // Ejecutar la sentencia
    if ($sentencia->execute()) {
        echo "Habitación actualizada correctamente.";
        header("Location: ./index.php");
    } else {
        echo "Error en actualizacion de la habitación.";
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
            <div class="container">
        <div class="container-fluid">
        <div class="card-body p-4">
    <h5 class="card-title fw-semibold mb-4">
        <?php echo isset($habitacion) ? '<h5 class="fw-bold" style="font-size: 2.4rem; position: relative; top: -27px; font-weight: 800;">
    Editar una habitacion
</h5>
' : 'Crear Nueva Habitación'; ?>
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
    <form action="editar.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="txtID" value="<?php echo isset($txtID) ? $txtID : ''; ?>">

    <div class="d-flex gap-4 mb-3">
        <div class="w-50">
            <label for="nh" class="form-label">Número de Habitación</label>
            <input type="text" class="form-control" id="nh" name="numeroH" 
            value="<?php echo isset($numeroH) ? $numeroH : ''; ?>" required>
        </div>
        <div class="w-50">
            <label for="dsh" class="form-label">Estado de Reserva</label>
            <select class="form-select" id="dsh" name="disponibilidadH" required>
                <option value="Disponible" <?php echo (isset($disponibilidadH) && $disponibilidadH == 'Disponible') ? 'selected' : ''; ?>>Disponible</option>
                <option value="Reservada" <?php echo (isset($disponibilidadH) && $disponibilidadH == 'Reservada') ? 'selected' : ''; ?>>Reservada</option>
                <option value="Limpieza" <?php echo (isset($disponibilidadH) && $disponibilidadH == 'Limpieza') ? 'selected' : ''; ?>>Limpieza</option>
            </select>
        </div>
    </div>

    <div class="d-flex gap-4 mb-3">
    <div class="w-50">
            <label for="select" class="form-label">Tipo de Habitación</label>
            <select class="form-select" id="select" name="tipoH" required>
                <?php foreach ($resultado_habitaciones as $habitacion) : ?>
                    <option value="<?php echo $habitacion['id_tipo_habitacion']; ?>" 
                    <?php echo ($tipoH == $habitacion['id_tipo_habitacion']) ? 'selected' : ''; ?>>
                        <?php echo $habitacion['tipo_habitacion']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="w-50">
            <label for="ch" class="form-label">Capacidad</label>
            <input type="number" class="form-control" id="ch" name="capacidadH" 
            value="<?php echo isset($capacidadH) ? $capacidadH : ''; ?>" required>
        </div>
    </div>

    <div class="d-flex gap-4 mb-3">
        <div class="w-50">
            <label for="ctoh" class="form-label">Precio por Noche</label>
            <input type="number" class="form-control" id="ctoh" name="costoH" 
            value="<?php echo isset($costoH) ? $costoH : ''; ?>" required>
        </div>
    </div>

    <div class="mb-3">
        <label for="dh" class="form-label">Descripción de la Habitación</label>
        <textarea class="form-control" id="dh" name="descrpcionH" rows="4" required><?php echo isset($descrpcionH) ? $descrpcionH : ''; ?></textarea>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-success">Guardar Cambios</button>
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