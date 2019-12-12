<?php

require_once "../includes/db/database.php";
$db = new Conexion();

$mysqli = $db->getConex();
session_start();

if (!empty($_GET)) {

    $keys = array_keys($_GET);

    $detalle_pedido = array();
    foreach ($keys as $key) {
        if ($_GET[$key] > 0) {
            array_push($detalle_pedido, ['ID' => $key, 'CANT' => $_GET[$key]]);
        }
    }
    $_SESSION['detalle_pedido'] = $detalle_pedido;
}

$error = '';

if (!empty($_POST)) {

    $CLIENTE = $_POST['nombre'] ." - ".$_POST['telefono']." - ".$_POST['direccion']; 
    $mysqli->autocommit(FALSE);

    $SQL_CREATE_PEDIDO = "INSERT INTO PEDIDO(PE_ID, PE_FECHA, CLIENTE) VALUES (null, CURDATE(),'".$CLIENTE."')";
    $mysqli->query($SQL_CREATE_PEDIDO);
    $id_pedido = mysqli_insert_id($mysqli);

    foreach ($_SESSION['detalle_pedido'] as $item) {
        $mysqli->query("INSERT INTO DETALLE_PEDIDO(DEPE_PE_ID, DEPE_GO_ID, DEPE_CANTIDAD) VALUES ('".$id_pedido."','".$item['ID']."','".$item['CANT']."')");
    }
    $_SESSION['detalle_pedido'] = [];

    if (!$mysqli->commit()) {
        $error = "Fallo al consignar la transacción";
        exit();
    }else $mensaje = "Registro de pedido, exitoso";
    
}

?>

        <link rel="stylesheet" href="http://localhost/golosinas-alpha/librerias/bootstrap/css/bootstrap.min.css">

        <div class="container">
            <div class="jumbotron">

                 <div class="text-center">
                    <h3>Ingrese datos del cliente</h3>
                </div>

                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

                    <div class="form-group row">
                        <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="nombre" required name="nombre">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="telefono" required name="telefono">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="direccion" class="col-sm-2 col-form-label">Direccion</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="direccion" required name="direccion">
                        </div>
                    </div>

                    <input type="submit" class="btn btn-info float-right" value="Registrar">
                    <a href="../tienda" class="btn btn-secondary float-left">Volver</a>
                </form>
                <div class="text-success text-center">
                    <?php echo isset($mensaje) ? $mensaje : ''; ?>
                </div>
                <div class="text-danger text-center">
                    <?php echo isset($error) ? $error : ''; ?>
                </div>
            </div>
        </div>

