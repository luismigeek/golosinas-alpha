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
        if($db->updatePresentacion($_POST) == 1){
            header('Location: ../presentaciones.php');
        } else {
            $error = "Lo sentimos, este sitio web está experimentando problemas.";
        }
    }
}

if (!empty($_GET)) {
    $id = (isset($_GET['id'])) ? $_GET['id']: null ;
    $error = '';

    $sql = "SELECT * FROM GO_PRESENTACIONES WHERE GOPRE_ID = '$id'";
    $result = $db->getConex()->query($sql);
    $rows = $result->num_rows;
        ?>
        <link rel="stylesheet" href="http://localhost/golosinas-alpha/librerias/bootstrap/css/bootstrap.min.css">

        <div class="container">
            <div class="jumbotron">

                <?php
                    if ($rows > 0) {
                        $row = $result->fetch_assoc();
                ?>

                <div class="text-center">
                    <h3>Renombrar presentacion</h3>
                </div>

                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        
                    <input type="hidden" name="id" value="<?php echo $row['GOPRE_ID']?>">

                    <div class="form-group row">
                        <div class="col-sm-5 m-auto">
                            <input type="text" class="form-control text-center" id="nombre" required name="e_nombre" value="<?php echo $row['GOPRE_DESC']?>">
                        </div>
                    </div>

                    <input type="submit" class="btn btn-info float-right" value="Actualizar">
                    <a href="../presentaciones.php" class="btn btn-secondary float-left">Volver</a>
                </form>
                <div class="text-danger text-center">
                    <?php echo isset($error) ? $error : ''; ?>
                </div>

            </div>
        </div>

        <?php
    } else {
        echo "No se encontró el proveedor que se quería editar";
    }
    $db->desconectar();
}
?>
