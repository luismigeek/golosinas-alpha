<?php

/**
 * La sentencia include incluye y evalúa el archivo especificado. Emite E_WARNING este falla.
 */

/**
 * require es idéntico a include excepto que en caso de fallo producirá un error fatal de nivel
 * E_COMPILE_ERROR. En otras palabras, éste detiene el script mientras que include sólo emitirá
 * una advertencia (E_WARNING) lo cual permite continuar el script.
 */

/**
 * La sentencia require_once es idéntica a require excepto que PHP verificará si el archivo ya
 * ha sido incluido y si es así, no se incluye (require) de nuevo.
 */

require_once "../includes/db/database.php";
$db = new Conexion();

session_start();

if (isset($_SESSION["type"]) && $_SESSION["type"] == 1) {
    header("Location: home.php");
}

if (!empty($_POST)) {

    $email = (isset($_POST['inputEmail'])) ? $_POST['inputEmail'] : null ;
    $passw = (isset($_POST['inputPassword'])) ? $_POST['inputPassword'] : null ;
    $error = '';

    $sql = "SELECT USAU_ID, USAU_USTI_ID FROM USER_AUTH WHERE USAU_EMAIL = '$email' AND USAU_PASSWORD = '$passw'";
    $result = $db->getConex()->query($sql);
    $rows = $result->num_rows;

    if ($rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['auth_id'] = $row['USAU_ID'];
        $_SESSION['type'] = $row['USAU_USTI_ID'];
        header("location: home.php");
    } else {
        $error = "El nombre o contraseña son incorrectos";
    }

    $db->desconectar();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Golosinas Alpha - Login</title>

  <!-- Custom fonts for this template-->
  <link href="../librerias/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <?php require_once "../includes/navLogin.php";?>

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
              <label for="inputEmail">Correo Electronico</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Contraseña</label>
            </div>
          </div>
          <button class="btn btn-primary btn-block" type="submit"> Login </button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="register.php">Registrar una cuenta</a>
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
