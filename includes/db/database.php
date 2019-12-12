<?php

require_once "config.php";

class Conexion
{

    protected $conex;

    /**
     * Metodo para crear una conexión con la base de datos, retorna TRUE si esta es exitosa
     */
    public function conectar()
    {

        $this->conex = new mysqli(HOST, USER, PASS, DBNAME);

        // comprueba la conexión
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        // devuelve el nombre de la base de datos actualmente seleccionada
        if ($result = $this->conex->query("SELECT DATABASE()")) {
            $row = $result->fetch_row();
            $result->close();
        }
        return true;
    }

    /**
     * Metodo para cierra una conexión con la base de datos
     */
    public function desconectar()
    {
        if ($this->conectar()) {
            $this->conex->close();
        }
    }

    /**
     * Metodo que retorna la conexion con la base de datos, en
     * caso de no haber conexiones retorna null
     */
    public function getConex()
    {
        if ($this->conectar()) {
            return $this->conex;
        } else {
            return null;
        }
    }

    /***************************************************************/
    /*                      Metodos para el CRUD                   */
    /***************************************************************/

    /**
     * Crud para la entidad Proveedor
     *
     * @method createProveedor(data[]) crea un registro en la tabla Proveedor y
     * recibe por parametro los datos del nuevo proveedor en un array
     *
     * @method readProveedores() obtiene una lista de con todos los proveedores
     *
     * @method updateProveedor(data[]) modifica un registro de la tabla Proveedor y los
     * datos a modificar los recibe por parametro en un array
     *
     * @method deleteProveedor(id) Elimina un registro en la tabla Proveedor,
     * recibe el ID del proveedor que va a eliminar
     */

    public function createProveedor($data = [])
    {
        // Verifica que el array no esté vacio
        if (count($data) > 0) {
            $sql = "INSERT INTO GO_PROVEEDOR (PR_ID, PR_NOMBRE, PR_ORIGEN, PR_SUCURSAL, PR_TELEFONO, PR_URL)
                VALUES (NULL, '" . $data['nombre'] . "', '" . $data['origen'] . "', '" . $data["sucursal"] . "', '" . $data["telefono"] . "', '" . $data["url"] . "')";

            if (!$resultado = $this->conex->query($sql)) {

                echo "Lo sentimos, este sitio web está experimentando problemas.";
                exit;

                // Cómo obtener información del error
                echo "Error: La ejecución de la consulta falló debido a: \n";
                echo "Query: " . $sql . "<br>";
                echo "Errno: " . $this->conex->errno . "<br>";
                echo "Error: " . $this->conex->error . "<br>";
                exit;
            } else {
                return $resultado;
            }

        } else {

            /**
             * Cuando la consulta se ejecuta exitosamente, esta retorna un '1', en este caso como
             * el array estaba vacio no se puede ejecutar nada, entoces vamos a retornar un '0'
             */
            return 0;
        }
    }

    public function readProveedores()
    {
        // Realizar una consulta SQL
        $sql = "SELECT * FROM GO_PROVEEDOR";

        if (!$resultado = $this->conex->query($sql)) {
            echo "Lo sentimos, este sitio web está experimentando problemas.";
            exit;

            // Como obtener información del error
            echo "Error: La ejecución de la consulta falló debido a: \n";
            echo "Query: " . $sql . "\n";
            echo "Errno: " . $this->conexion->errno . "\n";
            echo "Error: " . $this->conexion->error . "\n";
            exit;
        }

        if ($resultado->num_rows != 0) {
            $proveedores = array();
            while ($proveedor = $resultado->fetch_array(MYSQLI_ASSOC)) {
                array_push($proveedores, $proveedor);
            }
            $resultado->free();
            return $proveedores;
        } else {
            echo '<h3 class="text-secundary">Lo sentimos. No se encontraron datos.</h3>';
        }

    }

    public function updateProveedor($data = [])
    {

        // Verifica que el array no esté vacio
        if (count($data) > 0) {

            $url = (!empty($data['e_url'])) ? "https://" . $data['e_url'] : null;

            $sql = "UPDATE
                    GO_PROVEEDOR
                SET
                    PR_nombre = '" . $data['e_nombre'] . "',
                    PR_ORIGEN = '" . $data['e_origen'] . "',
                    PR_SUCURSAL = '" . $data['e_sucursal'] . "',
                    PR_TELEFONO = '" . $data['e_telefono'] . "',
                    PR_URL = '" . $url . "'
                WHERE GO_PROVEEDOR.PR_ID = " . $data['id'];

            $url = "";

            if (!$resultado = $this->conex->query($sql)) {
                echo "Lo sentimos, este sitio web está experimentando problemas.";
                exit;

                // Como obtener información del error
                echo "Error: La ejecución de la consulta falló debido a: \n";
                echo "Query: " . $sql . "<br>";
                echo "Errno: " . $this->conex->errno . "<br>";
                echo "Error: " . $this->conex->error . "<br>";
                exit;
            } else {
                return $resultado;
            }

        } else {
            return 0;
        }
    }

    public function deleteProveedor($id)
    {
        $sql = "DELETE FROM GO_PROVEEDOR WHERE GO_PROVEEDOR.PR_ID = $id";

        if (!$resultado = $this->conex->query($sql)) {
            echo "Lo sentimos, este sitio web está experimentando problemas.";
            exit;

            // Como obtener información del error
            echo "Error: La ejecución de la consulta falló debido a: \n";
            echo "Query: " . $sql . "<br>";
            echo "Errno: " . $this->conex->errno . "<br>";
            echo "Error: " . $this->conex->error . "<br>";
            exit;
        } else {
            return $resultado;
        }

    }

    /* Todos los CRUD funcionan de la misma manera, por eso se omite la documentación */

    /**********************/
    /* CRUD categorias*/
    /**********************/

    public function createCategoria($data = [])
    {
        if (count($data) > 0) {
            $sql = "INSERT INTO GO_CATEGORIAS (GOCA_ID, GOCA_DESC)
                VALUES (NULL, '" . $data['nombre'] . "')";

            if (!$resultado = $this->conex->query($sql)) {

                echo "Lo sentimos, este sitio web está experimentando problemas.";

                // Cómo obtener información del error
                echo "Error: La ejecución de la consulta falló debido a: \n";
                echo "Query: " . $sql . "<br>";
                echo "Errno: " . $this->conex->errno . "<br>";
                echo "Error: " . $this->conex->error . "<br>";
                exit;
            } else {
                return $resultado;
            }
        } else {
            return 0;
        }
    }

    public function readCategorias()
    {
        // Realizar una consulta SQL
        $sql = "SELECT * FROM GO_CATEGORIAS";

        if (!$resultado = $this->conex->query($sql)) {
            echo "Lo sentimos, este sitio web está experimentando problemas.";
            exit;
        }

        if ($resultado->num_rows != 0) {
            $categorias = array();
            while ($categoria = $resultado->fetch_array(MYSQLI_ASSOC)) {
                array_push($categorias, $categoria);
            }
            $resultado->free();
            return $categorias;
        } else {
            echo '<h3 class="text-secundary">Lo sentimos. No se encontraron datos.</h3>';
        }
    }

    public function updateCategoria($data = [])
    {

        // Verifica que el array no esté vacio
        if (count($data) > 0) {

            $sql = "UPDATE
                    GO_CATEGORIAS
                SET
                    GOCA_DESC = '" . $data['e_nombre'] . "'
                WHERE GOCA_ID = " . $data['id'];

            if (!$resultado = $this->conex->query($sql)) {
                echo "Lo sentimos, este sitio web está experimentando problemas.";

                // Como obtener información del error
                echo "Error: La ejecución de la consulta falló debido a: \n";
                echo "Query: " . $sql . "<br>";
                echo "Errno: " . $this->conex->errno . "<br>";
                echo "Error: " . $this->conex->error . "<br>";
                exit;
            } else {
                return $resultado;
            }

        } else {
            return 0;
        }
    }

    public function deleteCategoria($id)
    {
        $sql = "DELETE FROM GO_CATEGORIAS WHERE GOCA_ID = $id";

        if (!$resultado = $this->conex->query($sql)) {
            echo "Lo sentimos, este sitio web está experimentando problemas.";
            exit;

            // Como obtener información del error
            echo "Error: La ejecución de la consulta falló debido a: \n";
            echo "Query: " . $sql . "<br>";
            echo "Errno: " . $this->conex->errno . "<br>";
            echo "Error: " . $this->conex->error . "<br>";
            exit;
        } else {
            return $resultado;
        }

    }

    /***********************/
    /* CRUD presentaciones */
    /***********************/

    public function createPresentacion($data = [])
    {
        if (count($data) > 0) {
            $sql = "INSERT INTO GO_PRESENTACIONES (GOPRE_ID, GOPRE_DESC)
                VALUES (NULL, '" . $data['nombre'] . "')";

            if (!$resultado = $this->conex->query($sql)) {

                echo "Lo sentimos, este sitio web está experimentando problemas.";

                // Cómo obtener información del error
                echo "Error: La ejecución de la consulta falló debido a: \n";
                echo "Query: " . $sql . "<br>";
                echo "Errno: " . $this->conex->errno . "<br>";
                echo "Error: " . $this->conex->error . "<br>";
                exit;
            } else {
                return $resultado;
            }
        } else {
            return 0;
        }
    }

    public function readPresentaciones()
    {
        // Realizar una consulta SQL
        $sql = "SELECT * FROM GO_PRESENTACIONES";

        if (!$resultado = $this->conex->query($sql)) {
            echo "Lo sentimos, este sitio web está experimentando problemas.";
            exit;
        }

        if ($resultado->num_rows != 0) {
            $presentaciones = array();
            while ($presentacion = $resultado->fetch_array(MYSQLI_ASSOC)) {
                array_push($presentaciones, $presentacion);
            }
            $resultado->free();
            return $presentaciones;
        } else {
            echo '<h3 class="text-secundary">Lo sentimos. No se encontraron datos.</h3>';
        }
    }

    public function updatePresentacion($data = [])
    {

        // Verifica que el array no esté vacio
        if (count($data) > 0) {

            $sql = "UPDATE
                    GO_PRESENTACIONES
                SET
                    GOPRE_DESC = '" . $data['e_nombre'] . "'
                WHERE GOPRE_ID = " . $data['id'];

            if (!$resultado = $this->conex->query($sql)) {
                echo "Lo sentimos, este sitio web está experimentando problemas.";

                // Como obtener información del error
                echo "Error: La ejecución de la consulta falló debido a: \n";
                echo "Query: " . $sql . "<br>";
                echo "Errno: " . $this->conex->errno . "<br>";
                echo "Error: " . $this->conex->error . "<br>";
                exit;
            } else {
                return $resultado;
            }

        } else {
            return 0;
        }
    }

    public function deletePresentacion($id)
    {
        $sql = "DELETE FROM GO_PRESENTACIONES WHERE GOPRE_ID = $id";

        if (!$resultado = $this->conex->query($sql)) {
            echo "Lo sentimos, este sitio web está experimentando problemas.";
            exit;

            // Como obtener información del error
            echo "Error: La ejecución de la consulta falló debido a: \n";
            echo "Query: " . $sql . "<br>";
            echo "Errno: " . $this->conex->errno . "<br>";
            echo "Error: " . $this->conex->error . "<br>";
            exit;
        } else {
            return $resultado;
        }

    }

}
