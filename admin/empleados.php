<?php

require_once "../includes/db/database.php";
$db = new Conexion();

session_start();

/**
 * Si no hay una variable de sesion llamada "type" es porque no hay sesion iniciada,
 * Si esta existe y es diferente de 1, entonces es necesario redireccionar al login
 */
if (!isset($_SESSION["type"]) && $_SESSION["type"] != 1) {
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Administrador - Empleados</title>

  <!-- Custom fonts for this template-->
  <link href="../librerias/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Navigation -->
    <?php
require_once '../includes/navigation.php'
?>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php
require_once '../includes/sidebar.php'
?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">Inicio</a>
          </li>
          <li class="breadcrumb-item active">Empleados</li>
        </ol>

        <h1 class="d-inline">Empleados</h1> <a href="empleado/create.php" class="btn btn-success float-lg-right d-inline">Registrar nuevo</a>
        <hr>
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Empleados de Golosinas ALPHA 
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">

            <?php
                  if ($db->conectar()) {
                      $empleados = $db->readEmpleados();

                      if ($empleados != null) {
            ?>

              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre completo</th>
                    <th colspan = "2"  class="text-center" >ACCIONES</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($empleados as $empleado) {?>
                  <tr>
                    <td> <?php echo $empleado['EM_ID'] ?> </td>
                    <td> <?php echo $empleado['EM_NOMBRE']." ".$empleado['EM_APELLIDO']?> </td>
                    <td class="text-center">
                      <a class="btn btn-warning" href="empleado/update.php?id=<?php echo $empleado['EM_ID'] ?>">Editar</a>
                    </td>
                    <td class="text-center">
                      <a class="btn btn-danger" href="empleado/delete.php?id=<?php echo $empleado['EM_ID'] ?>">Eliminar</a>
                    </td>
                  </tr>
                  <?php }?>
                <?php }?>
                </tbody>
              </table>

                <?php
              }else {
                echo "No se pudo conectar a la base de datos";
              }
            ?>

            </div>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->

      <?php
        require_once '../includes/footer.php'
      ?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript-->
  <script src="../librerias/jquery/jquery.min.js"></script>
  <script src="../librerias/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>
</body>

</html>