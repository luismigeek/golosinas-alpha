<?php

require_once "../includes/db/database.php";
$db = new Conexion();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>INICIO - GOLOSINAS ALPHA</title>

  <!-- Bootstrap core CSS -->
  <link href="../librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/shop-homepage.css" rel="stylesheet">

  <style>

    body{
      background-image: url(../includes/fiesta.png) ;
      background-repeat: repeat;
      background-size: cover;
    }

  </style>

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">

      <a class="navbar-brand" href="#">Golosinas ALPHA</a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
              <a href="../admin" class="btn btn-info text-break">
                <span></span>Iniciar administrador
              </a>
            </li>
          </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">

        <img src="../includes/logo_tienda.jpg" width="250" height="250"  alt="">

        <br>
        <br>
        <br>
        <h4 class="text-success font-weight-bold">CATEGORIAS</h4>

        <div class="list-group">
        <?php

          if ($db->conectar()) {
              $categorias = $db->readCategorias();


              if ($categorias != null) {
                  foreach ($categorias as $categoria) {

                      ?>
                    
                      <a href="#" class="list-group-item"> <?php echo $categoria['GOCA_DESC'] ?></a>

                  <?php
                  }
              }
          }
        ?>
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" src="https://loremflickr.com/900/350/candy,sweet?random=1" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="https://loremflickr.com/900/350/candy,sweet?random=2" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="https://loremflickr.com/900/350/candy,sweet?random=3" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

        <form action="shop.php" method="get">
        <div class="row">

        <?php
          if ($db->conectar()) {
              $golosinas = $db->readGolosinas();

              if ($golosinas != null) {
        ?>

        
          <?php
                  $i = 1;
                  foreach ($golosinas as $golosina) {?>

                    <div class="col-lg-4 col-md-6 mb-4">
                      <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="https://loremflickr.com/720/400/candy,sweet?random=<?php echo $i; ?>" alt=""></a>
                        <div class="card-body">
                          <h4 class="card-title">
                            <a href="#"><?php echo $golosina['DESC'] ?> </a>
                          </h4>
                          <h5>Precio: $ <?php echo $golosina['PRECIO'] ?> </h5>
                          <p class="card-text">
                            <p class="d-inline" >Presentacion: </p> <p class="d-inline"> <?php echo $golosina['PRESENTACION'] ?> </p> <br>
                            <p class="d-inline" > Categoria: </p> <p class="d-inline"> <?php echo $golosina['CATEGORIA'] ?> </p> <br>
                          </p>
                        </div>
                        <div class="card-footer">
                          <input type="number" name="<?php echo $golosina['ID'] ?>" placeholder="Cantidad a comprar">
                        </div>
                      </div>
                    </div>

          <?php $i++;}?>

            <?php }?>
          <?php }?>


        </div>
        <!-- /.row -->
        <div class="row">
          <input type="submit" class="btn btn-success btn-lg mb-3 m-auto w-100" value="Pedir domicilio">
        </div>

      </div>
      <!-- /.col-lg-9 -->

      </form>

    </div>
    <!-- /.row -->



  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 mt-4 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Golosinas ALPHA 2019</p>
    </div>
    <!-- /.container -->
  </footer>

</body>

</html>