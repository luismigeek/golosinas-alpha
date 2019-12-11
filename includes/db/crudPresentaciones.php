<?php

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