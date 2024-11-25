<?php
include("../../conexion.php");


if (isset($_GET["txtID"])) {
    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";
    $sentencia = $conexion->prepare("DELETE FROM habitaciones WHERE id_habitacion = $txtID;
");

    $sentencia->execute();
    header("Location:index.php");
}

$sentencia = $conexion->prepare("SELECT h.id_habitacion, h.numero_habitacion, tp.tipo_habitacion, h.capacidad_habitacion, h.costo_habitacion
            FROM habitaciones h
            JOIN tipos_habitacion  tp ON tp.id_tipo_habitacion = h.tipo_habitacion_id;
");


$sentencia->execute();
$resultado_habitaciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);
// print_r($resultado_habitaciones);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/styles.min.css" />
    <link rel="shortcut icon" type="image/png" href="../../assets/images/logos/favicon.png" />
    <title>reservas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
<?php require '../../partials/index.php' ?>
<div class="container-content">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body py-2">
                    <a  class="card-title fw-semibold mb-4">Habitaciones</a>
                    <div class="table-responsive">
                        <div class="btn-create">
                            <a href="./crear.php">Crear habitacion nueva</a>
                        </div>
                        
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Id</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">No Habitacion</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Tipo habitacion</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Precio noche</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Capacidad</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Acciones</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($resultado_habitaciones as $key => $value) { ?>
                                    <tr></tr>

                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0"><?php echo $value["id_habitacion"] ?></h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1"><?php echo $value["numero_habitacion"] ?></h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?php echo $value["tipo_habitacion"] ?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="d-flex align-items-center gap-2">
                                            <span
                                                class="badge bg-primary rounded-3 fw-semibold">$<?php echo $value["costo_habitacion"] ?></span>
                                        </div>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 fs-4"><?php echo $value["capacidad_habitacion"] ?></h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <a href="editar.php?txtID=<?php echo $value["id_habitacion"] ?>" name="" id=""
                                            class="badge bg-warning rounded-3 fw-semibold">Editar</a>
                                        <a href="index.php?txtID=<?php echo $value["id_habitacion"] ?>" name="" id=""
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

</body>

</html>