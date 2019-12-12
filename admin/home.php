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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ADMINISTRADOR - DASHBOARD</title>

  <!-- Custom fonts for this template-->
  <link href="../librerias/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <?php
    include '../includes/navigation.php';
  ?>

  <div id="wrapper">

    <?php
      include '../includes/sidebar.php';
    ?>

    <div id="content-wrapper">

      <div class="container-fluid">


        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <h1 class="d-inline text-success">HISTORICO DE PEDIDOS </h1>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">

            <?php 
                  if ($db->conectar()) {
                    $pedidos = $db->listarPedidos();

                    if ($pedidos != null) {
            ?>

              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>CODIGO</th>
                    <th>FECHA</th>
                    <th>VALOR PEDIDO</th>
                    <th>CLIENTE</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($pedidos as $pedido) {?>
                    <tr>
                      <td> <?php echo $pedido['ID'] ?> </td>
                      <td> <?php echo $pedido['FECHA'] ?> </td>
                      <td> $ <?php echo $pedido['VALOR'] ?> </td>
                      <td> <?php echo $pedido['CLIENTE'] ?> </td>
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
        include '../includes/footer.php'
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