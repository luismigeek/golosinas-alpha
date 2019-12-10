<?php

require_once "config.php";

class Conexion
{
    protected $conexion;
    protected $db;

    public function conectar()
    {
        $this->conexion = new mysqli(HOST, USER, PASS, DBNAME);

        /* comprueba la conexión */
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        /* devuelve el nombre de la base de datos actualmente seleccionada */
        if ($result = $this->conexion->query("SELECT DATABASE()")) {
            $row = $result->fetch_row();
            $result->close();
        }
        return true;
    }

    public function desconectar()
    {
        if ($this->conectar()) {            
            $this->conexion->close();
        }
    }

    public function getEmpleados()
    {
        // Realizar una consulta SQL
        $sql = "SELECT * FROM EMPLEADO";

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
            // ¡Oh, no ha filas! Unas veces es lo previsto, pero otras
            // no. Nosotros decidimos. En este caso, ¿podría haber sido
            // actor_id demasiado grande? 
            echo "Lo sentimos. No se pudo encontraron datos. Inténtelo de nuevo.";
            exit;
        }

        $empleado = array();

        // Ahora, sabemos que existe solamente un único resultado en este ejemplo, por lo
        // que vamos a colocarlo en un array asociativo donde las claves del mismo son los
        // nombres de las columnas de la tabla
        while ($row = $resultado->fetch_array(MYSQLI_ASSOC)) {
            array_push($empleado, $row);   
        }

        return $empleado;

        $resultado->free();

        return $empleado;
    }

    public function getConexion()
    {
        if ($this->conectar()) {
            return $this->conexion;
        }else{
            return null;
        }
    }


}

