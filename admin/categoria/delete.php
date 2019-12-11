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
        if ($db->deleteCategoria($_POST['id']) == 1) {
            header('Location: ../categorias.php');
        } else {
            $error = "Lo sentimos, este sitio web está experimentando problemas.";
        }
    }
}

if (!empty($_GET)) {
    $id = (isset($_GET['id'])) ? $_GET['id'] : null;
    $error = '';

    $sql = "SELECT * FROM GO_CATEGORIAS WHERE GOCA_ID = '$id'";
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
                    <h3>Eliminar categoria</h3>
                </div>

                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="text-muted">
                        La siguiente categoría de dulces será eliminada:
                    </div>

                    <pre>
                        <ul>
                            <li><p class="d-inline text-danger">Categoria: </p> <?php echo $row['GOCA_DESC'] ?></li>
                        </ul>
                    </pre>

                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <button type="submit" class="btn btn-danger float-right">Proceder</button>
                    <a href="../categorias.php" class="btn btn-secondary float-left">Volver</a>
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
