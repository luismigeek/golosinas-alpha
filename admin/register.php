<?php

require_once "../includes/db/database.php";
$db = new Conexion();

session_start();

if (isset($_SESSION["type"]) && $_SESSION["type"] == 1) {
    header("Location: home.php");
}

if (!empty($_POST)) {

    $email = (isset($_POST['inputEmail'])) ? $_POST['inputEmail'] : null ;
    $passw = (isset($_POST['inputPassword'])) ? $_POST['inputPassword'] : null ;
    $passw2 = (isset($_POST['confirmPassword'])) ? $_POST['confirmPassword'] : null ;

    $error = '';

    if ($passw === $passw2 && $email != null)  {
      $sql = "INSERT INTO user_auth (USAU_ID, USAU_EMAIL, USAU_PASSWORD, USAU_USTI_ID) VALUES (NULL, '".$email."', '".$passw."', '1');";
      $db->getConex()->query($sql);
      
      header("location: home.php");
    } else {
      $error = "El nombre o contraseña son incorrectos";
    }  
    $db->desconectar();
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

  <title>Golosinas Alpha - Registrar una cuenta</title>

  <!-- Custom fonts for this template-->
  <link href="../librerias/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <?php require_once "../includes/navLogin.php";?>

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Registrar una cuenta</div>
      <div class="card-body">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required="required">
              <label for="inputEmail">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required="required">
                  <label for="inputPassword">Password</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm password" required="required">
                  <label for="confirmPassword">Confirm password</label>
                </div>
              </div>
            </div>
          </div>
          <button class="btn btn-primary btn-block" type="submit"> Registrar </button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="index.php">Ya tengo una cuenta</a>
        </div>
        <div class="text-danger text-center">
            <?php echo isset($error) ? $error : ''; ?>
        </div>
      </div>
    </div>
  </div>
  

  <!-- Bootstrap core JavaScript-->
  <script src="../librerias/jquery/jquery.min.js"></script>
  <script src="../librerias/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
