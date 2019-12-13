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
        
        if($db->createEmpleado($_POST) == 1){
            $mensaje = "Empleado insertado correctamente.";
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
                    <h3>Ingrese la informacion del nuevo empleado</h3>
                </div>

                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

                    <div class="form-group row">
                        <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="nombre" required name="nombre">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="apellido" class="col-sm-2 col-form-label">Apellido: </label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="apellido" required name="apellido">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telefono" class="col-sm-2 col-form-label">Telefono: </label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="telefono" required name="telefono">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="salario" class="col-sm-2 col-form-label">Salario: </label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="salario" required name="salario">
                        </div>
                    </div>

                    <input type="submit" class="btn btn-info float-right" value="Registrar">
                    <a href="../empleados.php" class="btn btn-secondary float-left">Volver</a>
                </form>
                <div class="text-success text-center">
                    <?php echo isset($mensaje) ? $mensaje : ''; ?>
                </div>
                <div class="text-danger text-center">
                    <?php echo isset($error) ? $error : ''; ?>
                </div>
            </div>
        </div>

 