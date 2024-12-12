<?php
include("../../conexion.php");

// Consulta SQL para obtener las promociones
$sentencia = $conexion->prepare("SELECT * FROM promociones");
$sentencia->execute();
$promociones = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Promociones</title>
    <link rel="shortcut icon" type="image/png" href="../../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../../assets/css/styles.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar -->
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



            <!-- <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">AUTH</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./authentication-login.html" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Login</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./authentication-register.html" aria-expanded="false">
                <span>
                  <i class="ti ti-user-plus"></i>
                </span>
                <span class="hide-menu">Register</span>
              </a>
            </li> -->
          </ul>
          
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
        <!-- Main wrapper -->
        <div class="body-wrapper">
            <!-- Header -->
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
                            
                        </ul>
                    </div>
                </nav>


                
            </header>

            <div class="container-fluid">
                <div class="container-content">
                    <div class="row">


                    
                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100">
                                <div class="card-body py-2">
                                    <h4 class="card-title fw-semibold mb-4">Promociones</h4>
                                    <div class="table-responsive">
                                        <div class="btn-create">
                                        <a href="./crear.php" class="btn btn-primary text-white">Agregar nueva promoción</a>

                                        </div>
                                        <table class="table text-nowrap mb-0 align-middle">
                                            <thead class="text-dark fs-4">
                                                <tr>
                                                    <th class="border-bottom-0">ID</th>
                                                    <th class="border-bottom-0">Tipo</th>
                                                    <th class="border-bottom-0">Nombre</th>
                                                    <th class="border-bottom-0">Descripción</th>
                                                    <th class="border-bottom-0">Descuento</th>
                                                    <th class="border-bottom-0">Inicio</th>
                                                    <th class="border-bottom-0">Fin</th>
                                                    <th class="border-bottom-0">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($promociones as $promocion) { ?>
                                                    <tr>
                                                        <td class="border-bottom-0"><?php echo $promocion["id_promocion"]; ?></td>
                                                        <td class="border-bottom-0"><?php echo $promocion["tp_id"]; ?></td>
                                                        <td class="border-bottom-0"><?php echo $promocion["nombre_promocion"]; ?></td>
                                                        <td class="border-bottom-0"><?php echo $promocion["descripcion"]; ?></td>
                                                        <td class="border-bottom-0"><?php echo number_format($promocion["descuento"] * 100, 2); ?>%</td>
                                                        <td class="border-bottom-0"><?php echo date("d/m/Y", strtotime($promocion["fecha_incio_promocion"])); ?></td>
                                                        <td class="border-bottom-0"><?php echo date("d/m/Y", strtotime($promocion["fecha_fin_promocion"])); ?></td>
                                                                <td>
                                                            <a href="editar.php?id=<?php echo $promocion["id_promocion"]; ?>" class="btn btn-primary btn-sm">
                                                            <i class="fa-solid fa-pencil"></i>
                                                        </a>
                                                        <a href="eliminar.php?id=<?php echo $promocion["id_promocion"]; ?>" class="btn btn-danger btn-sm">
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
</body>

</html>
