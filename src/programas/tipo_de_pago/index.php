<?php
include("../../conexion.php");

if (isset($_GET["txtID"])) {
    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";
    $sentencia = $conexion->prepare("DELETE FROM metodo_pago WHERE id_metodo_pago = :id");
    $sentencia->bindParam(':id', $txtID, PDO::PARAM_INT);
    $sentencia->execute();
    header("Location:index.php");
}

$sentencia = $conexion->prepare("SELECT id_metodo_pago, tipo_pago FROM metodo_pago");
$sentencia->execute();
$resultado_metodos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="es">

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
                    <div class="row">
                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100">
                                <div class="card-body py-2">
                                    <a class="card-title fw-semibold mb-4">Métodos de Pago</a>
                                    <div class="table-responsive">
                                        <div class="btn-create">
                                            <a href="crear.php" class="btn btn-primary text-white">Crear nuevo método de pago</a>
                                        </div>

                                        <table class="table text-nowrap mb-0 align-middle">
                                            <thead class="text-dark fs-4">
                                                <tr>
                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">Id</h6>
                                                    </th>
                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">Tipo de Pago</h6>
                                                    </th>
                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">Acciones</h6>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php foreach ($resultado_metodos as $key => $value) { ?>
                                                    <tr>
                                                        <td class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0"><?php echo $value["id_metodo_pago"] ?></h6>
                                                        </td>
                                                        <td class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-1"><?php echo $value["tipo_pago"] ?></h6>
                                                        </td>
                                                        <td class="border-bottom-0">
                                                            <!-- Enlace de edición -->
                                                            <a href="edit.php?id=<?php echo $value["id_metodo_pago"]; ?>"
                                                                class="badge bg-warning rounded-3 fw-semibold">Editar</a>

                                                            <!-- Enlace de eliminación -->
                                                            <a href="index.php?txtID=<?php echo $value["id_metodo_pago"] ?>"
                                                                class="badge bg-danger rounded-3 fw-semibold">Eliminar</a>
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
        <!-- End Body Wrapper -->
    </div>

    <script src="../../assets/js/modernize.min.js"></script>
    <script src="../../assets/js/core.js"></script>
</body>

</html>