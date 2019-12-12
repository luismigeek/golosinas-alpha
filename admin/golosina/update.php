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
        if($db->updateGolosina($_POST) == 1){
            header('Location: ../golosinas.php');
        } else {
            $error = "Lo sentimos, debe completar todos los campos.";
        }
        echo $db->updateGolosina($_POST);

    }
}

if (!empty($_GET)) {
    $id = (isset($_GET['id'])) ? $_GET['id']: null ;

    $sql = 'SELECT 
                GO.GO_ID AS "ID",
                GO.GO_DESC AS "DESC", 
                GO.GO_PRECIO AS "PRECIO", 
                GO.GO_STOCK AS "STOCK", 
                CONCAT( GOPR.PR_NOMBRE, " - ", GOPR.PR_SUCURSAL) AS "PROVEEDOR", 
                GOPRE.GOPRE_DESC AS "PRESENTACION", 
                GOCA.GOCA_DESC AS "CATEGORIA" 
            FROM 
                GOLOSINA GO 
                INNER JOIN GO_PROVEEDOR GOPR ON GO.GO_GOPR_ID = GOPR.PR_ID 
                INNER JOIN GO_CATEGORIAS GOCA ON GO.GO_GOCA_ID = GOCA.GOCA_ID 
                INNER JOIN GO_PRESENTACIONES GOPRE ON GO.GO_GOPRE_ID = GOPRE.GOPRE_ID 
            WHERE GO.GO_ID = '.$id;

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
                    <h3>Editar informacion de una golosina</h3>
                </div>

                <form action="<?php echo $_SERVER['PHP_SELF']."?id=".$row['ID'] ?>" method="POST">
                        
                    <input type="hidden" name="id" value="<?php echo $row['ID']?>">
                    <div class="form-group row">
                        <label for="desc" class="col-sm-2 col-form-label">Descripcion</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="desc" required name="desc" value="<?php echo $row['DESC']?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="precio" class="col-sm-2 col-form-label">Precio</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control" id="precio" required name="precio" value="<?php echo $row['PRECIO']?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="stock" class="col-sm-2 col-form-label">Disponibles</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="stock" required name="stock" value="<?php echo $row['STOCK']?>">
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
							<select class="form-control" id="id_proveedor" name="id_proveedor" required>
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


                    <input type="submit" class="btn btn-info float-right" value="Actualizar">
                    <a href="../golosinas.php" class="btn btn-secondary float-left">Volver</a>
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
