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
        if ($db->deleteGolosina($_POST['id']) == 1) {
            header('Location: ../golosinas.php');
        } else {
            $error = "Lo sentimos, este sitio web está experimentando problemas.";
        }
    }
}

if (!empty($_GET)) {
    $id = (isset($_GET['id'])) ? $_GET['id'] : null;
    $error = '';
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
                $golosina = $result->fetch_assoc();
            ?>

                <div class="text-center">
                    <h3>Eliminar golosina</h3>
                </div>

                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="text-muted">
                        La golosina con los siguientes datos será eliminada:
                    </div>

                    <pre>
                        <ul>
                            <li><p class="d-inline text-danger">Descripción: </p> <?php echo $golosina['DESC'] ?></li>
                            <li><p class="d-inline text-danger">Precio: </p>$<?php echo $golosina['PRECIO'] ?></li>
                            <li><p class="d-inline text-danger">Stock disponible: </p><?php echo $golosina['STOCK'] ?></li>
                            <li><p class="d-inline text-danger">Categoria: </p><?php echo $golosina['CATEGORIA'] ?></li>
                            <li><p class="d-inline text-danger">Presentacion: </p><?php echo $golosina['PRESENTACION'] ?></li>
                            <li><p class="d-inline text-danger">Proveedor: </p><?php echo $golosina['PROVEEDOR'] ?></li>
                        </ul>
                    </pre>

                    <input type="hidden" name="id" value="<?php echo $id ?>">

                    <button type="submit" class="btn btn-danger float-right">Proceder</button>
                    <a href="../golosinas.php" class="btn btn-secondary float-left">Volver</a>
                </form>
                <div class="text-danger text-center">
                    <?php echo isset($error) ? $error : ''; ?>
                </div>
            </div>
        </div>

        <?php
} else {
        echo "No se encontró la golosina que se quería eliminar";
    }

    $db->desconectar();
}
?>
