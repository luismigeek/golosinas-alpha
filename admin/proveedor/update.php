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
        $db->updateProveedor($_POST);
    }
}

if (!empty($_GET)) {
    $id = (isset($_GET['id'])) ? $_GET['id']: null ;
    $error = '';

    $sql = "SELECT * FROM GO_PROVEEDOR WHERE PR_ID = '$id'";
    $result = $db->getConexion()->query($sql);
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
                    <h3>Editar informacion de un proveedor</h3>
                </div>

                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        
                    <input type="hidden" name="id" value="<?php echo $row['PR_ID']?>">
                    <div class="form-group row">
                        <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row['PR_NOMBRE']?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="origen" class="col-sm-2 col-form-label">ORIGEN</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="origen" name="origen" value="<?php echo $row['PR_ORIGEN']?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="sucursal" class="col-sm-2 col-form-label">SUCURSAL</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="sucursal" name="sucursal" value="<?php echo $row['PR_SUCURSAL']?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telefono" class="col-sm-2 col-form-label">TELEFONO</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="telefono" name="telefono"value="<?php echo $row['PR_TELEFONO']?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="url" class="col-sm-2 col-form-label">URL</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="url" name="url" value="<?php echo $row['PR_URL']?>">
                        </div>
                    </div>

                    <input type="submit" class="btn btn-info float-right" value="Actualizar">
                    <a href="../proveedores.php" class="btn btn-secondary float-left">Volver</a>
                </form>
            </div>
        </div>

        <?php
    } else {
        echo "No se encontró el proveedor que se quería editar";
    }

    $db->desconectar();
}

?>
