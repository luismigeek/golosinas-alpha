<?php



$servidor = "localhost";
$usuario = "root";
$contrasena = ""; 
$basededatos = "tienda_online";

/**
 * Crear la conexión con el servidor de la base de datos mediante la función mysqli_connect() 
 * La variable $conexion contendrá la conexión.
 * "or die" en el caso de que la conexión con la base de datos no se haya podido realizar.
 */
$conexion = mysqli_connect( $servidor, $usuario, "" ) or die ("No se ha podido conectar al servidor de base de datos");

if ($conexion->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $conexion->connect_errno . ") " . $mysqli->connect_error;
}else{
    echo 'Conexión exitosa';
}
/**
 * Seleccionamos la base de datos que vamos a utilizar.
 */
$db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );

