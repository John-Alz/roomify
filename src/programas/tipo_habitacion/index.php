<?php
include("../../conexion.php");

// Eliminar tipo de habitación
if (isset($_GET["txtID"])) {
    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";
    $sentencia = $conexion->prepare("DELETE FROM tipos_habitacion WHERE id_tipo_habitacion = :id");
    $sentencia->bindParam(':id', $txtID, PDO::PARAM_INT);
    $sentencia->execute();
    header("Location:index.php");
    exit;
}

// Obtener todos los tipos de habitación
$sentencia = $conexion->prepare("SELECT id_tipo_habitacion, tipo_habitacion, num_camas, descripcion_tipo_habitacion FROM tipos_habitacion");
$sentencia->execute();
$resultado_tipos_habitacion = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tipos de Habitación</title>
    <link rel="shortcut icon" type="image/png" href="../../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../../assets/css/styles.min.css" />
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-center">
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
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../index.html" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="../programas/" aria-expanded="false">
                <span>
                  <i class="fa-solid fa-list-check"></i>
                </span>
                <span class="hide-menu">Reservas</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="../rooms/index.php" aria-expanded="false">
                <span>
                  <i class="fa-solid fa-house-user"></i>
                </span>
                <span class="hide-menu">Habitaciones</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="../huespedes/index.php" aria-expanded="false">
                <span>
                  <i class="fa-solid fa-person"></i>
                </span>
                <span class="hide-menu">Huespedes</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="../amenidades.html" aria-expanded="false">
                <span>
                  <i class="fa-solid fa-bell-concierge"></i>
                </span>
                <span class="hide-menu">Amenidades</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="../promo/index.php" aria-expanded="false">
                <span>
                  <i class="fa-solid fa-percent"></i>
                </span>
                <span class="hide-menu">Promociones</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="../usuarios/index.php" aria-expanded="false">
                <span>
                  <i class="fa-solid fa-user-group"></i>
                </span>
                <span class="hide-menu">Usuarios</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="../programas/tipo_habitacion/index.php" aria-expanded="false">
                <span>
                  <i class="fa-solid fa-house-user"></i>
                </span>
                <span class="hide-menu">Tipo de habitacion</span>
              </a>
            </li>
            
            <li class="sidebar-item">
              <a class="sidebar-link" href="../programas/tipo_de_pago/index.php" aria-expanded="false">
                <span>
                  <i class="fa-solid fa-percent"></i>
                </span>
                <span class="hide-menu">Metodo de pago</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
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
                                    <h5 class="card-title fw-semibold mb-4">Tipos de Habitación</h5>
                                    <div class="btn-create">
                                        <a href="../tipos_habitacion/crear.php" class="btn btn-primary text-white">Crear nuevo tipo de habitación</a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table text-nowrap mb-0 align-middle">
                                            <thead class="text-dark fs-4">
                                                <tr>
                                                    <th class="border-bottom-0">Id</th>
                                                    <th class="border-bottom-0">Tipo de Habitación</th>
                                                    <th class="border-bottom-0">Número de Camas</th>
                                                    <th class="border-bottom-0">Descripción</th>
                                                    <th class="border-bottom-0">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($resultado_tipos_habitacion as $value) { ?>
                                                    <tr>
                                                        <td class="border-bottom-0"><?php echo $value["id_tipo_habitacion"] ?></td>
                                                        <td class="border-bottom-0"><?php echo $value["tipo_habitacion"] ?></td>
                                                        <td class="border-bottom-0"><?php echo $value["num_camas"] ?></td>
                                                        <td class="border-bottom-0"><?php echo $value["descripcion_tipo_habitacion"] ?></td>
                                                        <td class="border-bottom-0">
                                                            <a href="edit.php?id=<?php echo $value["id_tipo_habitacion"]; ?>" class="badge bg-warning rounded-3 fw-semibold">Editar</a>
                                                            <a href="index.php?txtID=<?php echo $value["id_tipo_habitacion"] ?>" class="badge bg-danger rounded-3 fw-semibold">Eliminar</a>
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