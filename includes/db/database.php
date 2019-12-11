<?php

require_once "config.php";

class Conexion {

    protected $conexion;
    protected $db;

    public function conectar(){

        $this->conexion = new mysqli(HOST, USER, PASS, DBNAME);

        // comprueba la conexión
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        // devuelve el nombre de la base de datos actualmente seleccionada 
        if ($result = $this->conexion->query("SELECT DATABASE()")) {
            $row = $result->fetch_row();
            $result->close();
        }
        return true;
    }

    public function desconectar(){
        if ($this->conectar()) {            
                $this->conexion->close();
        }
    }

    public function getConexion(){
        if ($this->conectar()) {
            return $this->conexion;
        }else{
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
     * @method updateProveedor(data[]) modifca un registro de la tabla Proveedor y 
     * datos a modificar los recibe por parametro en un array
     * 
     * @method deleteProveedor(id) Elimina un registro en la tabla Proveedor, 
     * recibe el ID del proveedor que va a eliminar
     */

    public function createProveedor($data = []){
        // Escribir sql para actualizar los datos
        var_dump($data);
    }

    public function readProveedores(){

        // Realizar una consulta SQL
        $sql = "SELECT * FROM GO_PROVEEDOR";

        if (!$resultado = $this->conexion->query($sql)) {
            echo "Lo sentimos, este sitio web está experimentando problemas.";

            // De nuevo, no hacer esto en un sitio público, aunque nosotros mostraremos
            // cómo obtener información del error
            echo "Error: La ejecución de la consulta falló debido a: \n";
            echo "Query: " . $sql . "\n";
            echo "Errno: " . $this->conexionsqli->errno . "\n";
            echo "Error: " . $this->conexion->error . "\n";
            exit;
        }

        if ($resultado->num_rows === 0) {
            echo "Lo sentimos. No se pudo encontraron datos. Inténtelo de nuevo.";
            exit;
        }

        $proveedor = array();
        // Ahora, sabemos que existe solamente un único resultado en este ejemplo, por lo
        // que vamos a colocarlo en un array asociativo donde las claves del mismo son los
        // nombres de las columnas de la tabla
        while ($row = $resultado->fetch_array(MYSQLI_ASSOC)) {
            array_push($proveedor, $row);   
        }
        $resultado->free();
        return $proveedor;
    }   

    public function updateProveedor($data = []){
        // Escribir sql para actualizar los datos
        var_dump($data);
    }

    public function deleteProveedor($id){
        // Escribir sql para eliminar por UD
        var_dump($id);
    }



    /* Todos los CRUD funcionan de la misma manera, por eso se omite la documentación */

    /**********************/
    /* CRUD presentaciones*/
    /**********************/

    public function createPresentacion($data = []){
        // Escribir sql para actualizar los datos
        var_dump($data);
    }

    public function readPresentacion(){

        // Realizar una consulta SQL
        $sql = "SELECT * FROM GO_PRESENTACIONES";

        if (!$resultado = $this->conexion->query($sql)) {
            echo "Lo sentimos, este sitio web está experimentando problemas.";

            // De nuevo, no hacer esto en un sitio público, aunque nosotros mostraremos
            // cómo obtener información del error
            echo "Error: La ejecución de la consulta falló debido a: \n";
            echo "Query: " . $sql . "\n";
            echo "Errno: " . $this->conexionsqli->errno . "\n";
            echo "Error: " . $this->conexion->error . "\n";
            exit;
        }

        if ($resultado->num_rows === 0) {
            echo "Lo sentimos. No se pudo encontraron datos. Inténtelo de nuevo.";
            exit;
        }

        $proveedor = array();
        // Ahora, sabemos que existe solamente un único resultado en este ejemplo, por lo
        // que vamos a colocarlo en un array asociativo donde las claves del mismo son los
        // nombres de las columnas de la tabla
        while ($row = $resultado->fetch_array(MYSQLI_ASSOC)) {
            array_push($proveedor, $row);   
        }
        $resultado->free();
        return $proveedor;
    }   

    public function updatePresentacion($data = []){
        // Escribir sql para actualizar los datos
        var_dump($data);
    }

    public function deletePesentacion($id){
        // Escribir sql para eliminar por UD
        var_dump($id);
    }
}