<?php

require_once "../../includes/db/database.php";
$db = new Conexion();

session_start();

/**
 * Si no hay una variable de sesion llamada "type" es porque no hay sesion iniciada,
 * Si esta existe y es diferente de 1, entonces es necesario redireccionar al login
 */
if (!isset($_SESSION["type"]) && $_SESSION["type"] != 1) {
    header("Location: index.php");
}

if (!empty($_POST)) {
    if ($db->conectar()) {
        
        if($db->createCategoria($_POST) == 1){
            $mensaje = "Categoría insertada correctamente.";
        }else {
            $error = "Lo sentimos, este sitio web está experimentando problemas.";
        }
    }
}
?>
        <link rel="stylesheet" href="http://localhost/golosinas-alpha/librerias/bootstrap/css/bootstrap.min.css">

        <div class="container">
            <div class="jumbotron">

                 <div class="text-center">
                    <h3>Ingrese el nombre de la nueva categoría de golosinas</h3>
                </div>

                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        
                    <div class="form-group row ">
                        <div class="col-sm-5 m-auto">
                            <input type="text" class="form-control text-center" id="nombre" required name="nombre">
                        </div>
                    </div>

                    <input type="submit" class="btn btn-info float-right" value="Registrar">
                    <a href="../categorias.php" class="btn btn-secondary float-left">Volver</a>
                </form>
                <div class="text-success text-center">
                    <?php echo isset($mensaje) ? $mensaje : ''; ?>
                </div>
                <div class="text-danger text-center">
                    <?php echo isset($error) ? $error : ''; ?>
                </div>
            </div>
        </div>

 