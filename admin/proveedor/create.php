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
        $db->createProveedor($_POST);
    }
}
?>
        <link rel="stylesheet" href="http://localhost/golosinas-alpha/librerias/bootstrap/css/bootstrap.min.css">

        <div class="container">
            <div class="jumbotron">

                 <div class="text-center">
                    <h3>Ingrese la informacion del nuevo proveedor</h3>
                </div>

                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        
                    <div class="form-group row">
                        <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="origen" class="col-sm-2 col-form-label">Origen</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="origen" name="origen" placeholder="Local o extrangero">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="sucursal" class="col-sm-2 col-form-label">Sucursal</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="sucursal" name="sucursal">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telefono" class="col-sm-2 col-form-label">Telefon</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="telefono" name="telefono">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="url" class="col-sm-2 col-form-label">Url</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="url" name="url">
                        </div>
                    </div>

                    <input type="submit" class="btn btn-info float-right" value="Registrar">
                    <a href="../proveedores.php" class="btn btn-secondary float-left">Volver</a>
                </form>
            </div>
        </div>

 