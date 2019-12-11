<?php

require_once "database.php";
$db = new Conexion();

if ($db->conectar()) {
    $empleados = $db->getEmpleados();

    ?>

<table style="width:50%">
<thead>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Telefono</th>
        <th>Salario</th>
    </tr>
</thead>

<tbody>
    <?php foreach ($empleados as $empleado) { ?>
    <tr>
        <?php foreach ($empleado as $data) { ?>
        <td> <?php echo $data; ?></td>
        <?php } ?>
    </tr>
    <?php }?>
</tbody>
</table>

 <?php  $db->desconectar(); 
 }

?>
