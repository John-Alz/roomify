<?php
include("../../conexion.php");

// Verifica si el ID se encuentra en la URL
if (!isset($_GET['id_usuario']) || empty($_GET['id_usuario'])) {
    echo "ID de usuario no proporcionado. Valor de id_usuario: " . (isset($_GET['id_usuario']) ? $_GET['id_usuario'] : 'No está definido');
    exit; // Detiene la ejecución si no se proporciona el ID
}

$id_usuario = $_GET['id_usuario']; // Captura el ID de la URL
echo("id =" . $id_usuario);

// Verifica que el ID sea un número válido
if (!is_numeric($id_usuario)) {
    echo "ID no válido.";
    exit; // Detiene la ejecución si el ID no es un número
}

// Consulta al usuario basado en el ID
$sentencia = $conexion->prepare("SELECT * FROM usuarios WHERE id_usuario = :id_usuario");
$sentencia->bindParam(':id_usuario', $id_usuario);
$sentencia->execute();
$usuario = $sentencia->fetch(PDO::FETCH_ASSOC);

// Verifica si el usuario existe
if (!$usuario) {
    echo "Usuario no encontrado.";
    exit; // Detiene la ejecución si no se encuentra el usuario
}

// Actualiza el usuario cuando se envíe el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre_usuario'];
    $email = $_POST['email_usuario'];
    $contrasena_usuario = $_POST['contrasena_usuario'];
    $rol_id = $_POST['rol_id'];
    $fecha_creacion = $_POST['fecha_creacion_usuario'];
    $estado = $_POST['estado_usuario'];

    // Crea una nueva consulta para actualizar al usuario
    $sentencia = $conexion->prepare("UPDATE usuarios SET 
        nombre_usuario = :nombre, 
        email_usuario = :email, 
        contrasena_usuario = :contrasena, 
        rol_id = :rol_id,
        fecha_creacion_usuario = :fecha_creacion, 
        estado_usuario = :estado
        WHERE id_usuario = :id_usuario");

    // Enlaza los parámetros de la consulta con los valores del formulario
    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':email', $email);
    $sentencia->bindParam(':contrasena', $contrasena_usuario);
    $sentencia->bindParam(':rol_id', $rol_id);
    $sentencia->bindParam(':fecha_creacion', $fecha_creacion);
    $sentencia->bindParam(':estado', $estado);
    $sentencia->bindParam(':id_usuario', $id_usuario);

    // Ejecuta la consulta y redirige si es exitosa
    if ($sentencia->execute()) {
        header("Location: index.php"); // Redirige a la lista de usuarios
        exit;
    } else {
        echo "Error al actualizar el usuario.";
    }
}
?>

<?php
include("../../conexion.php");

if (isset($_GET['id'])) {
    $id_promocion = $_GET['id'];
    $sentencia = $conexion->prepare("SELECT * FROM promociones WHERE id_promocion = :id_promocion");
    $sentencia->bindParam(':id_promocion', $id_promocion);
    $sentencia->execute();
    $promocion = $sentencia->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tp_id = $_POST['tp_id'];
    $nombre_promocion = $_POST['nombre_promocion'];
    $descripcion = $_POST['descripcion'];
    $descuento = $_POST['descuento'];
    $fecha_inicio_promocion = $_POST['fecha_inicio_promocion'];
    $fecha_fin_promocion = $_POST['fecha_fin_promocion'];

    $sentencia = $conexion->prepare("UPDATE promociones SET tp_id = :tp_id, nombre_promocion = :nombre_promocion, descripcion = :descripcion, 
                                    descuento = :descuento, fecha_incio_promocion = :fecha_inicio_promocion, fecha_fin_promocion = :fecha_fin_promocion 
                                    WHERE id_promocion = :id_promocion");
    $sentencia->bindParam(':id_promocion', $id_promocion);
    $sentencia->bindParam(':tp_id', $tp_id);
    $sentencia->bindParam(':nombre_promocion', $nombre_promocion);
    $sentencia->bindParam(':descripcion', $descripcion);
    $sentencia->bindParam(':descuento', $descuento);
    $sentencia->bindParam(':fecha_inicio_promocion', $fecha_inicio_promocion);
    $sentencia->bindParam(':fecha_fin_promocion', $fecha_fin_promocion);

    if ($sentencia->execute()) {
        echo "Promoción actualizada correctamente.";
        header("Location: index.php");
    } else {
        echo "Error al actualizar la promoción.";
    }
}
?>

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
                <div class="container-content">
                <div class="container-fluid">
                <div class="card-body p-4">
    <h5 class="card-title fw-semibold mb-4">Editar Usuario</h5>

    <!-- Formulario de Edición de Usuario -->
    <form action="editar.php?id_usuario=<?php echo $usuario['id_usuario']; ?>" method="POST" class="mt-6">
        <div class="d-flex gap-4 mb-3">
            <div class="w-50">
                <label for="nombre_usuario" class="form-label">Nombre del Usuario</label>
                <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" 
                    value="<?php echo $usuario['nombre_usuario']; ?>" required>
            </div>
            <div class="w-50">
                <label for="email_usuario" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email_usuario" name="email_usuario" 
                    value="<?php echo $usuario['email_usuario']; ?>" required>
            </div>
        </div>

        <div class="d-flex gap-4 mb-3">
            <div class="w-50">
                <label for="contrasena_usuario" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contrasena_usuario" name="contrasena_usuario" 
                    value="<?php echo $usuario['contrasena_usuario']; ?>" required>
            </div>
            <div class="w-50">
                <label for="rol_id" class="form-label">Rol</label>
                <select class="form-control" id="rol_id" name="rol_id" required>
                    <option value="1" <?php echo ($usuario['rol_id'] == 1 ? 'selected' : ''); ?>>Administrador</option>
                    <option value="2" <?php echo ($usuario['rol_id'] == 2 ? 'selected' : ''); ?>>Recepcionista</option>
                </select>
            </div>
        </div>

        <div class="d-flex gap-4 mb-3">
            <div class="w-50">
                <label for="fecha_creacion_usuario" class="form-label">Fecha de Creación</label>
                <input type="date" class="form-control" id="fecha_creacion_usuario" name="fecha_creacion_usuario" 
                    value="<?php echo $usuario['fecha_creacion_usuario']; ?>" required readonly>
            </div>
            <div class="w-50">
                <label for="estado_usuario" class="form-label">Estado</label>
                <select class="form-control" id="estado_usuario" name="estado_usuario" required>
                    <option value="activo" <?php echo ($usuario['estado_usuario'] == 'activo' ? 'selected' : ''); ?>>Activo</option>
                    <option value="inactivo" <?php echo ($usuario['estado_usuario'] == 'inactivo' ? 'selected' : ''); ?>>Inactivo</option>
                </select>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">Actualizar Usuario</button>
            <button type="button" class="btn btn-danger" onclick="window.location.href='index.php';">Cancelar</button>
        </div>
    </form>
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