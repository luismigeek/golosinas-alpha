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
        $db->editProveedor($_POST);
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
                    <h3>Eliminar proveedor</h3>
                </div>

                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="text-muted">
                        El proveedor con los siguientes datos será eliminado:
                    </div>

                    <pre>
                        <ul>
                            <li><p class="d-inline text-danger">Nombre: </p> <?php echo $row['PR_NOMBRE']?></li>
                            <li><p class="d-inline text-danger">De origen: </p><?php echo $row['PR_ORIGEN']?></li>
                            <li><p class="d-inline text-danger">Sucursal en: </p><?php echo $row['PR_SUCURSAL']?></li>
                            <li><p class="d-inline text-danger">Telefono: </p><?php echo $row['PR_TELEFONO']?></li>
                            <li><p class="d-inline text-danger">Pagina web: </p><?php echo ($row['PR_URL'] !== null) ? $row['PR_URL'] : "No especifica";  ?></li>
                        </ul>
                    </pre>

                    <button type="submit" class="btn btn-info float-right">Proceder</button>
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
