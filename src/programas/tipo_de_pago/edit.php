<?php
include("../../conexion.php");

if (isset($_GET['id'])) {
    $id_metodo_pago = $_GET['id'];

   
    $sentencia = $conexion->prepare("SELECT * FROM metodo_pago WHERE id_metodo_pago = :id");
    $sentencia->bindParam(':id', $id_metodo_pago, PDO::PARAM_INT);
    $sentencia->execute();
    $metodo_pago = $sentencia->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_metodo_pago = $_POST['id_metodo_pago'];
    $tipo_pago = $_POST['tipo_pago'];


    $sentencia = $conexion->prepare("UPDATE metodo_pago SET tipo_pago = :tipo_pago WHERE id_metodo_pago = :id");
    $sentencia->bindParam(':id', $id_metodo_pago, PDO::PARAM_INT);
    $sentencia->bindParam(':tipo_pago', $tipo_pago, PDO::PARAM_STR);
    $sentencia->execute();

    header("Location: index.php");
}
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Método de Pago</title>
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
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="./index.html" class="text-nowrap logo-img">
                        <img src="../../assets/images/logos/roomify-logo.svg" width="180" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
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
        <!-- Sidebar End -->

        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!-- Header Start -->
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
                                    <a href="#" class="me-3"><i class="fas fa-bell fs-4"></i></a>
                                    <a href="#" class="profile-icon"><img src="../../assets/images/logos/Ellipse.png" alt="Perfil" class="rounded-circle" width="40"></a>
                                </div>
                            </ul>
                        </div>
                    </nav>
                </div>
            </header>
            <!-- Header End -->

            <!--  Edit Form -->
            <div class="container-fluid">
                <div class="container-content">
                    <div class="row">
                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100">
                                <div class="card-body py-2">
                                    <h3 class="card-title fw-semibold mb-4">Editar Método de Pago</h3>
                                    <form method="POST" action="edit.php">
                                        <input type="hidden" name="id_metodo_pago" value="<?php echo $metodo_pago['id_metodo_pago']; ?>">

                                        <div class="mb-3">
                                            <label for="tipo_pago" class="form-label">Tipo de Pago</label>
                                            <select class="form-select" id="tipo_pago" name="tipo_pago" required>
                                                <option value="Tarjeta de Crédito" <?php echo ($metodo_pago['tipo_pago'] == 'Tarjeta de Crédito') ? 'selected' : ''; ?>>Tarjeta de Crédito</option>
                                                <option value="Efectivo" <?php echo ($metodo_pago['tipo_pago'] == 'Efectivo') ? 'selected' : ''; ?>>Efectivo</option>
                                                <option value="Transferencia Bancaria" <?php echo ($metodo_pago['tipo_pago'] == 'Transferencia Bancaria') ? 'selected' : ''; ?>>Transferencia Bancaria</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                        <a href="index.php" class="btn btn-secondary">Cancelar</a>
                                    </form>
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
