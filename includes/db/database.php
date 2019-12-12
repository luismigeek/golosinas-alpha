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
            echo '<h3 class="text-secundary">No hay categorías registradas.</h3>';
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

    /**
     * INSERT INTO GOLOSINA (GO_ID, GO_DESC, GO_PRECIO, GO_STOCK, GO_GOPR_ID, GO_GOCA_ID, GO_GOPRE_ID) VALUES (NULL, 'C', '5755', '6455', '19', '11', '4');
     * SELECT GO.GO_ID AS "ID", GO.GO_DESC AS "DESC", GO.GO_PRECIO AS "PRECIO", GO.GO_STOCK AS "STOCK", CONCAT( GOPR.PR_NOMBRE, ' - ', GOPR.PR_SUCURSAL) AS "PROVEEDOR", GOPRE.GOPRE_DESC AS "PRESENTACION", GOCA.GOCA_DESC AS "CATEGORIA" FROM GOLOSINA GO INNER JOIN GO_PROVEEDOR GOPR ON GO.GO_GOPR_ID = GOPR.PR_ID INNER JOIN GO_CATEGORIAS GOCA ON GO.GO_GOCA_ID = GOCA.GOCA_ID INNER JOIN GO_PRESENTACIONES GOPRE ON GO.GO_GOPRE_ID = GOPRE.GOPRE_ID
     */

    public function createGolosina($data = [])
    {
        if (count($data) > 0) {
            $sql = "INSERT INTO GOLOSINA 
                        (GO_ID, GO_DESC, GO_PRECIO, GO_STOCK, GO_GOPR_ID, GO_GOCA_ID, GO_GOPRE_ID) 
                    VALUES 
                        (NULL, '".$data['desc']."', ".$data['precio'].", ".$data['stock'].", ".$data['id_proveedor'].", ".$data['id_categoria'].", ".$data['id_presentacion'].")";

            if (!$resultado = $this->conex->query($sql)) {
                return null;
            } else {
                return $resultado;
            }
        } else {
            return 0;
        }
    }

    public function readGolosinas()
    {
        // Realizar una consulta SQL
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
                    INNER JOIN GO_PRESENTACIONES GOPRE ON GO.GO_GOPRE_ID = GOPRE.GOPRE_ID';

        if (!$resultado = $this->conex->query($sql)) {
            echo "Lo sentimos, este sitio web está experimentando problemas.";
            exit;
        }

        if ($resultado->num_rows != 0) {
            $golosinas = array();
            while ($golosina = $resultado->fetch_array(MYSQLI_ASSOC)) {
                array_push($golosinas, $golosina);
            }
            $resultado->free();
            return $golosinas;
        } else {
            echo '<h3 class="text-secundary">Lo sentimos. No hay golosinas registradas.</h3>';
        }
    }

    public function updateGolosina($data = [])
    {

        // Verifica que el array no esté vacio
        /**
         * 
         */
        if (count($data) > 0) {

            $sql = "UPDATE 
                        GOLOSINA 
                    SET 
                        GO_DESC='".$data['desc']."',
                        GO_PRECIO=".$data['precio'].",
                        GO_STOCK=".$data['stock'].",
                        GO_GOCA_ID=".$data['id_categoria'].",
                        GO_GOPRE_ID=".$data['id_presentacion'].",
                        GO_GOPR_ID=".$data['id_proveedor']."
                    WHERE GO_ID=".$data['id'];

            if (!$resultado = $this->conex->query($sql)) {
                return null;
            } else {
                return $resultado;
            }

        } else {
            return 0;
        }
    }

    public function deleteGolosina($id)
    {
        $sql = "DELETE FROM GOLOSINA WHERE GO_ID = $id";

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


    /**
     * SELECT PE.PE_ID AS ID, PE.PE_FECHA AS FECHA, CONCAT (US.US_NOMBRE, ' ', US.US_APELLIDO) AS CLIENTE, CONCAT (EM.EM_NOMBRE, ' ', EM.EM_APELLIDO) AS REPARTIDOR, SUM(GO.GO_PRECIO) AS VALOR FROM PEDIDO PE INNER JOIN USUARIO US ON PE.PE_US_ID = US.US_ID INNER JOIN EMPLEADO EM ON PE.PE_EM_ID = EM.EM_ID INNER JOIN DETALLE_PEDIDO DP ON PE.PE_ID = DP.DEPE_PE_ID INNER JOIN GOLOSINA GO ON DP.DEPE_GO_ID = GO.GO_ID
     */
    
    public function listarPedidos()
    {
        // Realizar una consulta SQL
        $sql = "SELECT
                    PE.PE_ID AS ID,
                    PE.PE_FECHA AS FECHA,
                    PE.CLIENTE AS CLIENTE,
                    SUM(G.GO_PRECIO * DP.DEPE_CANTIDAD) AS VALOR
                FROM
                    PEDIDO PE
                INNER JOIN DETALLE_PEDIDO DP ON
                    PE.PE_ID = DP.DEPE_PE_ID
                INNER JOIN GOLOSINA G ON
                    DP.DEPE_GO_ID = G.GO_ID
                GROUP BY
                    PE.PE_ID";

        if (!$resultado = $this->conex->query($sql)) {
            echo "Lo sentimos, este sitio web está experimentando problemas.";
            exit;
        }

        if ($resultado->num_rows != 0) {
            $pedidos = array();
            while ($pedido = $resultado->fetch_array(MYSQLI_ASSOC)) {
                array_push($pedidos, $pedido);
            }
            $resultado->free();
            return $pedidos;
        } else {
            echo '<h3 class="text-secundary">Lo sentimos. No se encontraron pedidos.</h3>';
        }
    }

    public function lomascomprado()
    {
        // Realizar una consulta SQL
        $sql = "SELECT GO.GO_DESC AS CANDY, SUM(DP.DEPE_CANTIDAD) AS VENTAS, SUM(GO.GO_PRECIO * DP.DEPE_CANTIDAD) AS RECAUDO FROM PEDIDO PE INNER JOIN DETALLE_PEDIDO DP ON PE.PE_ID = DP.DEPE_PE_ID INNER JOIN GOLOSINA GO ON DP.DEPE_GO_ID = GO.GO_ID GROUP BY CANDY ORDER BY VENTAS DESC";

        if (!$resultado = $this->conex->query($sql)) {
            echo "Lo sentimos, este sitio web está experimentando problemas.";
            exit;
        }

        if ($resultado->num_rows != 0) {
            $lomas = array();
            while ($row = $resultado->fetch_array(MYSQLI_ASSOC)) {
                array_push($lomas, $row);
            }
            $resultado->free();
            return $lomas;
        } else {
            echo '<h3 class="text-secundary">Lo sentimos. No se encontraron pedidos.</h3>';
        }
    }
    

}
