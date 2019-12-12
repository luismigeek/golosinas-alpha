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

$error = '';

if (!empty($_POST)) {

    if ($db->conectar()) {
        if($db->createGolosina($_POST) == 1){
            $mensaje = "Golosina insertada correctamente.";
        }else {
            $error = "Lo sentimos, debe completar todos los campos.";
        }
    }
}


?>
        <link rel="stylesheet" href="http://localhost/golosinas-alpha/librerias/bootstrap/css/bootstrap.min.css">

        <div class="container">
            <div class="jumbotron">

                 <div class="text-center">
                    <h3>Ingrese la informacion de la golosina que desea registrar </h3>
                </div>

                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        
                    <div class="form-group row">
                        <label for="desc" class="col-sm-2 col-form-label">Descripcion</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="desc" required name="desc">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="precio" class="col-sm-2 col-form-label">Precio</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control" id="precio" required name="precio">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="stock" class="col-sm-2 col-form-label">Disponibles</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="stock" required name="stock">
                        </div>
                    </div>

                    <div class="form-group row">
						<label for="id_categoria" class="col-sm-2 control-label">Categoria: </label>
						<div class="col-sm-10">
							<select class="form-control" id="id_categoria" name="id_categoria">
								<option value=""> Seleccionar </option>
									<?php
										$sql = "SELECT * FROM GO_CATEGORIAS";
										$result = $db->getConex()->query($sql);

                                        while ($row = $result->fetch_array()) {
											echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
										}
									?>
							</select>
						</div>
                    </div>

                    <div class="form-group row">
						<label for="id_presentacion" class="col-sm-2 control-label">Presentacion: </label>
						<div class="col-sm-10">
							<select class="form-control" id="id_presentacion" name="id_presentacion">
								<option value=""> Seleccionar </option>
									<?php
										$sql = "SELECT * FROM GO_PRESENTACIONES";
										$result = $db->getConex()->query($sql);

                                        while ($row = $result->fetch_array()) {
											echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
										}
									?>
							</select>
						</div>
                    </div>

                    <div class="form-group row">
						<label for="id_proveedor" class="col-sm-2 control-label">Proveedor: </label>
						<div class="col-sm-10">
							<select class="form-control" id="id_proveedor" name="id_proveedor">
								<option value=""> Seleccionar </option>
									<?php
										$sql = "SELECT * FROM GO_PROVEEDOR";
										$result = $db->getConex()->query($sql);

                                        while ($row = $result->fetch_array()) {
											echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
										}
									?>
							</select>
						</div>
                    </div>


                    <input type="submit" class="btn btn-info float-right" value="Registrar">
                    <a href="../golosinas.php" class="btn btn-secondary float-left">Volver</a>
                </form>
                <div class="text-success text-center">
                    <?php echo isset($mensaje) ? $mensaje : ''; ?>
                </div>
                <div class="text-danger text-center">
                    <?php echo isset($error) ? $error : ''; ?>
                </div>
            </div>
        </div>

 